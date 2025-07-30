<template>
    <section class="create-appointment-section">
        <h2 class="section-title create-title">
            <svg class="section-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            Nueva Cita
        </h2>
        <AppointmentForm @add="addAppointment" />
    </section>

    <section class="appointments-section">
        <h2 class="section-title">Próximas Citas</h2>

        <ul v-if="appointments.length > 0" class="appointments-list">
            <li v-for="appointment in sortedAppointments" :key="appointment.id" class="appointment-item">
                <div class="appointment-card">
                    <div class="appointment-details">
                        <div class="appointment-datetime">
                            <p class="appointment-date">
                                <svg class="appointment-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                    <path d="M8 14h.01" />
                                    <path d="M12 14h.01" />
                                    <path d="M16 14h.01" />
                                    <path d="M8 18h.01" />
                                    <path d="M12 18h.01" />
                                    <path d="M16 18h.01" />
                                </svg>
                                {{ formatDate(appointment.date) }}
                            </p>
                            <p class="appointment-time">
                                <svg class="appointment-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 6v6H8" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                                {{ formatTime(appointment.date) }}
                            </p>
                        </div>
                        <p class="patient-name">
                            <svg class="appointment-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            {{ appointment.patient }}
                        </p>
                        <p class="status-appointment">
                            Estado:
                            <span class="status-badge" :class="{
                                'status-confirmed': appointment.status === 'Confirmada',
                                'status-cancelled': appointment.status === 'Cancelada'
                            }">
                                {{ appointment.status }}
                            </span>
                        </p>
                    </div>
                    <div class="appointment-actions">
                        <button @click="cancelAppointment(appointment.id)" class="cancel-btn"
                            aria-label="cancelar cita">
                            <svg class="cancel-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            Cancelar
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <p v-else class="text-gray-500">No hay citas programadas.</p>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { DateTime } from 'luxon'
import AppointmentForm from './AppointmentForm.vue'

const LOCAL_STORAGE_KEY = 'appointments'

const defaultAppointments = [
    {
        id: 1,
        patient: 'Juan Pérez',
        date: '2025-07-28T15:00:00Z',
        status: 'Confirmada',
    },
    {
        id: 2,
        patient: 'María García',
        date: '2025-07-29T18:30:00Z',
        status: 'Pendiente',
    },
    {
        id: 3,
        patient: 'Luis Rodríguez',
        date: '2025-08-01T10:00:00Z',
        status: 'Confirmada',
    },
    {
        id: 4,
        patient: 'Ana Torres',
        date: '2025-08-02T14:15:00Z',
        status: 'Cancelada',
    },
    {
        id: 5,
        patient: 'Carlos Méndez',
        date: '2025-08-03T09:30:00Z',
        status: 'Pendiente',
    },
    {
        id: 6,
        patient: 'Lucía Fernández',
        date: '2025-08-04T16:45:00Z',
        status: 'Confirmada',
    },
    {
        id: 7,
        patient: 'Javier Gómez',
        date: '2025-08-05T11:00:00Z',
        status: 'Cancelada',
    },
    {
        id: 8,
        patient: 'Camila Ramírez',
        date: '2025-08-06T13:00:00Z',
        status: 'Pendiente',
    },
    {
        id: 9,
        patient: 'Diego Sánchez',
        date: '2025-08-07T17:30:00Z',
        status: 'Confirmada',
    },
    {
        id: 10,
        patient: 'Valentina Ruiz',
        date: '2025-08-08T08:15:00Z',
        status: 'Pendiente',
    },
    {
        id: 11,
        patient: 'Fernando Castro',
        date: '2025-08-09T12:00:00Z',
        status: 'Cancelada',
    },
    {
        id: 12,
        patient: 'Sofía Herrera',
        date: '2025-08-10T15:45:00Z',
        status: 'Confirmada',
    }
]

const appointments = ref([])
const professionalCalendar = ref([])
const clientCalendar = ref([])

onMounted(() => {
    const saved = localStorage.getItem(LOCAL_STORAGE_KEY)
    appointments.value = saved ? JSON.parse(saved) : defaultAppointments
    professionalCalendar.value = [...appointments.value]
    clientCalendar.value = [...appointments.value]
})

watch(
    appointments,
    (newVal) => {
        localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(newVal))
    },
    { deep: true }
)

const sendCancellationEmail = (appointment) => {
    // Simulación de envío de email
    const { patient, date } = appointment;

    const formattedDate = new Date(date).toLocaleDateString('es-AR', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });

    const formattedTime = new Date(date).toLocaleTimeString('es-AR', {
        hour: '2-digit',
        minute: '2-digit',
    });

    alert(`Correo de CANCELACIÓN enviado a profesional y cliente:
    - Paciente: ${patient}
    - Fecha: ${formattedDate}
    - Hora: ${formattedTime}`);
}

const addAppointment = async (formData) => {
    const { patient, date, time } = formData

    const dateTime = DateTime.fromFormat(`${date} ${time}`, 'yyyy-MM-dd HH:mm')
    if (!dateTime.isValid) return alert('Fecha u hora inválidas')

    const combinedDateTime = dateTime.toUTC().toISO()
    const isSlotTaken = appointments.value.some(appt => DateTime.fromISO(appt.date).toMillis() === dateTime.toMillis())

    if (isSlotTaken) return alert('Ese horario ya está ocupado')

    const newAppointment = {
        id: Date.now(),
        patient,
        date: combinedDateTime,
        status: 'Confirmada',
    }

    // Guardar en el frontend
    appointments.value.push(newAppointment)
    professionalCalendar.value.push(newAppointment)
    clientCalendar.value.push(newAppointment)

    // Enviar correo desde Laravel
    try {
        await fetch('/api/appointments', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                patient,
                date,
                time,
            }),
        })
        alert('Correo de confirmación enviado')
    } catch (err) {
        console.error(err)
        alert('Error al enviar correo')
    }
}

const cancelAppointment = (id) => {
    const appointment = appointments.value.find(appt => appt.id === id)
    if (!appointment) return

    if (!confirm(`¿Seguro que quieres cancelar la cita con ${appointment.patient}?`)) {
        return
    }

    // Cambiar estado a "Cancelada"
    appointment.status = 'Cancelada'

    // Eliminar de calendarios profesionales y cliente
    professionalCalendar.value = professionalCalendar.value.filter(appt => appt.id !== id)
    clientCalendar.value = clientCalendar.value.filter(appt => appt.id !== id)

    sendCancellationEmail(appointment)
}

const sortedAppointments = computed(() =>
    [...appointments.value].sort((a, b) => new Date(a.date) - new Date(b.date))
)

const formatDate = (isoDate) =>
    DateTime.fromISO(isoDate).toLocal().toLocaleString(DateTime.DATE_MED)

const formatTime = (isoDate) =>
    DateTime.fromISO(isoDate).toLocal().toLocaleString(DateTime.TIME_SIMPLE)
</script>
