<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Estado;
use App\Models\Medico;
use Livewire\Component;
use App\Models\Paciente;
use App\Models\Tratamiento;
use Livewire\WithPagination;
use App\Models\Procedimiento;
use Livewire\WithFileUploads;
use App\Charts\PacientesChart;
use Illuminate\Support\Facades\Auth;

class PacientesController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $nombre,$ci,$telefono,$email,$image,$direccion,$enfermedad,$medicamentos,$alergias,$selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;

    public $citas = [];
    public $pagos = [];
    public $saldosprocedimientos;

    public $total = 0;
    public $pendiente = 0;
    public $pacientes = 0;

    public $sumExtras = 0;

    public $saldoPendiente=0;

    public $saldoFavor =0;

    // varaibles para agendar
    public $fecha_ini, $fecha_fin,$descripcion,$medico_id,$receta,$tratamiento_id,$totalcanceladocita=0,$estado;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName ='Pacientes';
        $this->status ='Elegir';



    }
    public function render()
    {
        $total = Paciente::all();
        $this->pacientes = count($total);

        if(strlen($this->search) > 0)
            $data = Paciente::where('nombre', 'like', '%' . $this->search . '%')->orwhere('ci', 'like', '%' . $this->search . '%')
            ->select('*')->orderBy('id','asc')->paginate($this->pagination);
        else
           $data = Paciente::select('*')->orderBy('id','asc')->paginate($this->pagination);
           $total =  $data->count();


        return view('livewire.pacientes.component', [
            'data' => $data,
            'medicos' => Medico::all(),
            'tratamientos' => Tratamiento::all(),
            'estados' => Estado::all(),
            //'procedimientos' => $procedimientos
        ])
        ->extends('layouts.theme.app')->section('content');

        //dd($total);
    }

    public function resetUI()
    {
        $this->nombre ='';
        $this->ci='';
        $this->telefono='';
        $this->email='';
        $this->image ='';
        $this->direccion ='';
        $this->enfermedad ='';
        $this->medicamentos ='';
        $this->alergias ='';
        $this->search ='';
        $this->selected_id =0;
        $this->descripcion ='';
        $this->fecha_ini = '';
        $this->fecha_fin = '';
        $this->medico_id = '';
        $this->receta = '';
        $this->tratamiento_id = '';
        $this->precio_tratamiento = '';
        $this->totalcanceladocita = 0;
        $this->saldo_cita = '';
        $this->estado_pago = '';
        $this->estado = '';
        $this->resetValidation();
        $this->resetPage();

    }

    public function Store()
    {
        $rules =[
            'nombre' => 'required|min:3',
            'ci' => 'required|unique:pacientes',
            'telefono' => 'required|max:10',
            'email' => 'unique:pacientes|email'
        ];

        $messages =[
            'nombre.required' => 'Ingresa el nombre',
            'nombre.min' => 'El nombre del paciente debe tener al menos 3 caracteres',
            'ci.unique' => 'El núemro de cédula ya existe en sistema',
            'ci.required' => 'Ingresa número de cédula',
            'telefono.required' => 'Ingresa el telefono',
            'telefono.max' => 'El teléfono debe tener máximo 10 caracteres',
            'email.unique' => 'El email ya existe en sistema',
            'email.email' => 'Ingresa una dirección de correo válida'
        ];

      $this->validate($rules,$messages);

        $paciente =  Paciente::create([
            'nombre' => $this->nombre,
            'ci' => $this->ci,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'enfermedad' => $this->enfermedad,
            'medicamentos' => $this->medicamentos,
            'alergias' => $this->alergias
        ]);

        if($this->image)
        {
            $customFileName = uniqid() . ' _.' . $this->image->extension();
            $this->image->storeAs('public/pacientes', $customFileName);
            $paciente->image = $customFileName;
            $paciente->save();
        }

        $this->resetUI();
        $this->emit('paciente-added','Paciente Registrado');


    }

    public function edit(Paciente $paciente)
    {
        $this->selected_id = $paciente->id;
        $this->nombre = $paciente->nombre;
        $this->ci = $paciente->ci;
        $this->telefono = $paciente->telefono;
        $this->email = $paciente->email;
        $this->direccion = $paciente->direccion;
        $this->enfermedad = $paciente->enfermedad;
        $this->medicamentos = $paciente->medicamentos;
        $this->alergias = $paciente->alergias;
       // dd($paciente);
        $this->emit('show-modal','open!');

    }

    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'

    ];

    public function detallePaciente ($idpaciente)
    {


         $procedimie =  new Procedimiento();
         $paciente = Paciente::find($idpaciente);
         $this->saldosprocedimientos =  $procedimie->calcularSaldoParaPaciente($idpaciente);
        //dd($this->saldosprocedimientos);
        $cit = $paciente->citas;

        //$tratamiento =  Tratamiento::find($cit->tratamiento_id);

        $this->citas = $cit;
        $this->emit('show-detail','details loaded');


    }

    public function Update()
    {
            $rules =[
                'nombre' => 'required|min:3',
                'ci' => "unique:pacientes,ci,{$this->selected_id}",
                'telefono' => 'required|max:10',
                'email' => "unique:pacientes,email,{$this->selected_id}"

            ];
            $messages =[
                'nombre.required' => 'Ingresa el nombre',
                'nombre.min' => 'El nombre del paciente debe tener al menos 3 caracteres',
                'ci.unique' => 'El núemro de cédula ya existe en sistema',
                'ci.required' => 'Ingresa número de cédula',
                'telefono.required' => 'Ingresa el telefono',
                'telefono.max' => 'El teléfono debe tener máximo 10 caracteres',
                'email.unique' => 'El email ya existe en sistema',
                'email.email' => 'Ingresa una dirección de correo válida'
            ];

            $this->validate($rules,$messages);

            $paciente =  Paciente::find($this->selected_id);
            //dd($paciente);
            $paciente->update([
                'nombre' => $this->nombre,
                'ci' => $this->ci,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'enfermedad' => $this->enfermedad,
                'medicamentos' => $this->medicamentos,
                'alergias' => $this->alergias
            ]);

            if($this->image)
        {
            $customFileName = uniqid() . ' _.' . $this->image->extension();
            $this->image->storeAs('public/pacientes', $customFileName);
            $imageTemp = $paciente->image;

            $paciente->image = $customFileName;
            $paciente->save();

            if($imageTemp !=null)
            {
                if(file_exists('storage/pacientes/' . $imageTemp)) {
                    unlink('storage/pacientes/' . $imageTemp);
                }
            }


        }

        $this->resetUI();
        $this->emit('paciente-updated','Paciente Actualizado');

    }

    public function updateValores() {

        $tratamiento =  Tratamiento::find($this->tratamiento_id);
        //dd($this->total);
        //$this->tratamiento = $tratamiento->nombre;
        $this->precio_tratamiento = $tratamiento->precio;
        $this->saldo_cita =  $this->precio_tratamiento - $this->totalcanceladocita;
    }

    public function agendar($idpaciente)
    {
        //dd($idpaciente);
         $this->selected_id = $idpaciente;
        // $this->nombre = $paciente->nombre;
        // $this->ci = $paciente->ci;
        // $this->telefono = $paciente->telefono;
        // $this->email = $paciente->email;
        // $this->direccion = $paciente->direccion;
        // $this->enfermedad = $paciente->enfermedad;
        // $this->medicamentos = $paciente->medicamentos;
        // $this->alergias = $paciente->alergias;
       // dd($paciente);
        $this->emit('show-modal-','open!');


    }

    public function AgendarCita(){
        $this->validaFechas();
        $rules = [


            'medico_id' => 'required',
            'tratamiento_id' => 'required',
            'estado' => 'required',
            'totalcanceladocita' => 'required',

         ];
         $messages =[
            'medico_id.required' => 'Ingresa un medico',
            'tratamiento_id.required' => 'Ingresa un tratamiento',
            'totalcanceladocita.required' => 'Ingresa el  valor de la consulta pagado',
            'estado.required' => 'Ingresa un estado'
         ];

         $this->validate($rules, $messages);
         $tratamiento =  Tratamiento::find($this->tratamiento_id);

        // dd($this->selected_id, $this->fecha_ini, $this->fecha_fin, $this->descripcion, $this->medico_id, $this->receta, $this->tratamiento_id,
        //      $this->totalcanceladocita, $this->saldo_cita, $this->estado);
        $cita = Cita::create([
            'descripcion' => $this->descripcion,
            'fecha_ini' => $this->fecha_ini,
            'fecha_fin' => $this->fecha_fin,
            'paciente_id' => $this->selected_id,
            'medico_id' => $this->medico_id,
            'receta' => $this->receta,
            'user_id' => Auth::user()->id,
            'tratamiento_id' => $this->tratamiento_id,
            'precio_tratamiento' => $this->precio_tratamiento,
            'total' => $this->totalcanceladocita,
            'saldo_cita' => $this->saldo_cita,
            //'estado_pago' => $this->estado_pago,
            'estado_id' => $this->estado
        ]);
        $cita->save();
        $this->resetUI();
        $this->emit('cita-added','cita registrada correctamente');

    }

    public  function destroy(Paciente $paciente)
        {

        $paciente->delete();
        $this->resetUI();
        $this->emit('paciente-deleted','Paciente Eliminado');

    }

    public function validaFechas()
    {
        if($this->fecha_ini == null || $this->fecha_fin == null)
       {
        $this->emit('cita-error','Selecciona una fecha válida');
        return;
       }
       else
       {
        if($this->fecha_fin <= $this->fecha_ini)
        {
            $this->emit('cita-error','Fecha final debe ser mayor a fecha inicial');
            return;
        }

       }
    }





}
