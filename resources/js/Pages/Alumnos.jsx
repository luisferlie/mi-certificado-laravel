import React from "react";

function Alumnos({ alumnos }) {
    return (
        <ul clasName="flex text-blue-600 p-">
            {alumnos.map((alumno, i) => (
                <li key={i}>
                    <p>{alumno.nombre}</p>
                </li>
            ))}
        </ul>
    );
}

export default Alumnos;
