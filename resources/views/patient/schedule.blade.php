{{-- @extends('layouts.app')

@section('title', 'Agendar Cita')

@section('content')
<div class="container">
    <h1 class="mb-4">Agendar Cita Médica</h1>
    <form action="{{ route('patient.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="appointment_date">Fecha de la Cita</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>
        <div class="form-group">
            <label for="specialty">Especialidad</label>
            <select class="form-control" id="specialty" name="specialty" required>
                <option value="cardiology">Cardiología</option>
                <option value="dermatology">Dermatología</option>
                <!-- Agrega más especialidades aquí -->
            </select>
        </div>
        <div class="form-group">
            <label for="doctor">Médico</label>
            <select class="form-control" id="doctor" name="doctor" required>
                <option value="dr_smith">Dr. Smith</option>
                <option value="dr_jones">Dr. Jones</option>
                <!-- Agrega más médicos aquí -->
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_time">Horario</label>
            <select class="form-control" id="appointment_time" name="appointment_time" required>
                <option value="morning">Mañana</option>
                <option value="afternoon">Tarde</option>
                <!-- Agrega más horarios aquí -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Agendar una Cita Médica</h1>
    <form id="appointmentForm" method="post" action="#">
        @csrf
        <!-- Selección de Especialidad -->
        <div class="form-group">
            <label for="specialty">Especialidad:</label>
            <select id="specialty" name="specialty" class="form-control" required>
                <option value="">Seleccione una especialidad</option>
                <option value="cardiologia">Cardiología</option>
                <option value="dermatologia">Dermatología</option>
                <option value="pediatria">Pediatría</option>
            </select>
        </div>

        <!-- Selección de Doctor -->
        <div id="doctorSection" class="form-group d-none">
            <label for="doctor">Doctor:</label>
            <select id="doctor" name="doctor" class="form-control" required>
                <option value="">Seleccione un doctor</option>
                <option value="dr_smith">Dr. Smith</option>
                <option value="dr_jones">Dr. Jones</option>
                <option value="dr_brown">Dr. Brown</option>
            </select>
        </div>

        <!-- Selección de Horario -->
        <div id="timeSection" class="form-group d-none">
            <label for="time">Horario:</label>
            <select id="time" name="time" class="form-control" required>
                <option value="">Seleccione un horario</option>
                <option value="08:00">08:00 AM</option>
                <option value="08:30">08:30 AM</option>
                <option value="09:00">09:00 AM</option>
            </select>
        </div>

        <!-- Confirmación de Cita -->
        <div id="confirmationSection" class="d-none">
            <h2 class="text-center my-4">Confirmación de Cita</h2>
            <p>Especialidad: <span id="confirmSpecialty"></span></p>
            <p>Doctor: <span id="confirmDoctor"></span></p>
            <p>Horario: <span id="confirmTime"></span></p>
            <button type="button" id="confirmButton" class="btn btn-success">Confirmar</button>
            <a href="{{ route('patient.dashboard') }}" class="btn btn-danger">Cancelar</a>
        </div>

        <!-- Mensaje de Éxito -->
        <div id="successMessage" class="d-none">
            <h2 class="text-center my-4 text-success">Se ha agendado su cita exitosamente</h2>
            <div class="text-center">
                <a href="{{ route('patient.appointments.list') }}" class="btn btn-primary">Ver todas mis citas programadas</a>
                <a href="{{ route('patient.dashboard') }}" class="btn btn-secondary">Aceptar</a>
            </div>
        </div>

        <button id="nextButton" type="button" class="btn btn-primary mt-3">Siguiente</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const specialtySelect = document.getElementById('specialty');
        const doctorSection = document.getElementById('doctorSection');
        const doctorSelect = document.getElementById('doctor');
        const timeSection = document.getElementById('timeSection');
        const timeSelect = document.getElementById('time');
        const confirmationSection = document.getElementById('confirmationSection');
        const confirmButton = document.getElementById('confirmButton');
        const successMessage = document.getElementById('successMessage');
        const nextButton = document.getElementById('nextButton');
        const appointmentForm = document.getElementById('appointmentForm');

        nextButton.addEventListener('click', function () {
            if (!specialtySelect.value) {
                alert('Por favor, seleccione una especialidad');
                return;
            }

            if (specialtySelect.value && !doctorSelect.value) {
                doctorSection.classList.remove('d-none');
                return;
            }

            if (doctorSelect.value && !timeSelect.value) {
                timeSection.classList.remove('d-none');
                return;
            }

            if (timeSelect.value) {
                confirmationSection.classList.remove('d-none');
                document.getElementById('confirmSpecialty').innerText = specialtySelect.options[specialtySelect.selectedIndex].text;
                document.getElementById('confirmDoctor').innerText = doctorSelect.options[doctorSelect.selectedIndex].text;
                document.getElementById('confirmTime').innerText = timeSelect.options[timeSelect.selectedIndex].text;
                nextButton.classList.add('d-none');
            }
        });

        confirmButton.addEventListener('click', function () {
            confirmationSection.classList.add('d-none');
            successMessage.classList.remove('d-none');
        });
    });
</script>
@endsection
