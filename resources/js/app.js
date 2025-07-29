import './bootstrap';

import { createApp } from "vue";
import AppointmentList from "./components/AppointmentList.vue";

const el = document.querySelector("#appointment-app");
if (el) {
    createApp(AppointmentList).mount(el);
}