<template>
    <form @submit.prevent="submitAppointment" class="appointment-form">
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Paciente</label>
                <input v-model="patient" type="text" class="form-input" placeholder="Ingrese nombre del Paciente"
                    required />
            </div>
            <div class="form-container-groups">
                <div class="form-group">
                    <label class="form-label">Fecha</label>
                    <input v-model="date" type="date" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Hora</label>
                    <input v-model="time" type="time" class="form-input" required />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="create-btn" aria-label="Crear Cita">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Crear cita
            </button>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue'

const emit = defineEmits(['add'])

const patient = ref('')
const date = ref('')
const time = ref('')

const submitAppointment = () => {
    if (!patient.value || !date.value || !time.value) {
        alert('Por favor completa todos los campos')
        return
    }

    emit('add', {
        patient: patient.value,
        date: date.value,  // en formato yyyy-MM-dd
        time: time.value,  // en formato HH:mm
    })

    // Limpiar formulario
    patient.value = ''
    date.value = ''
    time.value = ''
}
</script>
