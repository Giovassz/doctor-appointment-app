<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

//Gestión de Roles
Route::resource('roles', RoleController::class);

//Gestión de Usuarios
Route::resource('users', UserController::class);

//Gestión de Pacientes
Route::resource('patients', PatientController::class);

//Gestión de Doctores
Route::resource('doctors', DoctorController::class);

// Gestión de Citas
Route::get('appointments', [App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/create', [App\Http\Controllers\Admin\AppointmentController::class, 'create'])->name('appointments.create');

// Gestión de Consultas
Route::get('appointments/{appointment}/consultation', App\Livewire\Admin\ConsultationManager::class)->name('consultations.manage');

// Horarios de Doctores (Placeholder)
Route::get('doctors/{doctor}/schedules', App\Livewire\Admin\DoctorSchedule::class)->name('doctors.schedules');

// Calendario
Route::get('calendar', App\Livewire\Admin\Calendar::class)->name('calendar');