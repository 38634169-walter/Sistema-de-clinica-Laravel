<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\Session;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\PacientesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/','index')
    ->middleware('redireccionarSesionIniciada')
    ->name('index');

Route::view('/login','login')
    ->middleware('redireccionarSesionIniciada')
    ->name('login');

Route::post('/login',[UsuariosController::class,'confirm'])
    ->middleware('redireccionarSesionIniciada')
    ->name('login.confirm');

Route::view('/inicio','inicio')
    ->middleware('sesionIniciada')
    ->name('inicio');

Route::get('/salir',[UsuariosController::class,'destroy'])
    ->name('usuario.destroy');



Route::get('/inicio/asignar-paciente',[UsuariosController::class,'doctores'])
    ->middleware('AutenticacionSecretaria')
    ->name('asignarPaciente');

Route::post('/inicio/asignar-paciente/consultar-horarios',[TurnosController::class,'consultar_horarios'])
    ->middleware('AutenticacionSecretaria')
    ->name('consultarHorarios');

Route::post('/inicio/asignar-paciente/guardar', [TurnosController::class,'store'])
    ->middleware('AutenticacionSecretaria')
    ->name('turnos.store');

Route::view('/inicio/registrar-paciente','secretaria/registrarPaciente')
    ->middleware('AutenticacionSecretaria')
    ->name('registrarPaciente');
    
Route::post('/inicio/registrar-paciente',[PacientesController::class,'store'])
    ->middleware('AutenticacionSecretaria')
    ->name('registrarPaciente.store');

Route::get('/inicio/lista-turnos',[TurnosController::class,'show'])
    ->middleware('AutenticacionSecretaria')
    ->name('listaTurnos.show');

Route::post('/inicio/lista-turnos/buscar',[TurnosController::class,'show2'])
    ->middleware('AutenticacionSecretaria')
    ->name('listaTurnos.show2');

Route::get('/inicio/listaTurnos/{turno}',[TurnosController::class,'turnoInfo'])
    ->middleware('AutenticacionSecretaria')
    ->name('listaTurnos.turnoInfo');

Route::delete('/inicio/listaTurnos/{turno}/eliminar',[TurnosController::class,'delete'])
    ->middleware('AutenticacionSecretaria')
    ->name('listaTurnos.delete');

Route::get('/inicio/listaTurnos/{turno}/editar',[TurnosController::class,'edit'])
    ->middleware('AutenticacionSecretaria')
    ->name('listaTurnos.edit');

Route::post('/inicio/listaTurnos/editar/consultar-horarios-edicion',[TurnosController::class,'consultarHorariosEdicion'])
    ->middleware('AutenticacionSecretaria')
    ->name('consultarHorariosEdicion');
    

Route::put('/inicio/listaTurnos/editar/consultar-horarios-edicion/guardar-edicion',[TurnosController::class,'guardarEdicionTurno'])
    ->middleware('AutenticacionSecretaria')
    ->name('guardarEdicionTurno');



Route::get('/inicio/ver-pacientes',[PacientesController::class,'show'])
->middleware('AutenticacionDoctor')
->name('verPacientes');

Route::post('/inicio/ver-pacientes',[PacientesController::class,'buscar_paciente'])
->middleware('AutenticacionDoctor')
->name('buscarPaciente');

Route::get('/inicio/ver-pacientes/{id}/ver-historial',[PacientesController::class,'ver_historial'])
->middleware('AutenticacionDoctor')
->name('verHistorial');

Route::get('/inicio/ver-pacientes/{id}/agregar-historial',[PacientesController::class,'agregar_historial'])
->middleware('AutenticacionDoctor')
->name('agregarHistorial');

Route::post('/inicio/ver-pacientes/{id}/agregar-historial/guardar-historial',[PacientesController::class,'guardar_historial'])
->middleware('AutenticacionDoctor')
->name('guardarHistorial');

Route::get('/inicio/ver-mis-turnos',[TurnosController::class,'ver_mis_turnos'])
->middleware('AutenticacionDoctor')
->name('verMisTurnos');

Route::post('/inicio/ver-mis-turnos/buscar-turno',[TurnosController::class,'buscar_turno_doctor'])
->middleware('AutenticacionDoctor')
->name('buscarTurnoDoctor');

Route::get('/inicio/ver-mis-turnos/ver-turno/{id}',[TurnosController::class,'ver_turno_doctor'])
->middleware('AutenticacionDoctor')
->name('verTurnoDoctor');