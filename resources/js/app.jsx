import './bootstrap';
// import 'Code.jsx';

import React from "react";
import {createRoot} from "react-dom/client";

import Saludo from "./Pages/Saludo.jsx";
import Numero from "./Pages/Numero.jsx";
import Alumnos from "./Pages/Alumnos.jsx";

const react_numero = document.getElementById("react-numero");
const react_saludo = document.getElementById("react-saludo");
const react_alumnos = document.getElementById("react-alumnos");

if (react_numero){
    const numero= react_numero.getAttribute('numero');
    createRoot(react_numero).render(<Numero numero={numero}/>);
}

if (react_saludo){
    createRoot(react_saludo).render(<Saludo />);
}
if (react_alumnos){
    const alumnos=JSON.parse(react_alumnos.getAttribute('alumnos'));

    createRoot(react_alumnos).render(<Alumnos alumnos={alumnos} />);
}
