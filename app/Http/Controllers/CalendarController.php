<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public  function index()
    {
        return Cita::all();
        //dd(Cita::all());
    }
}
