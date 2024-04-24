import Instrumento from "../entities/Instrumento";

export async function getAllInstrumentos(){
    const urlServer = 'http://localhost/Back-Instrumentos/funciones.php';
    const response = await fetch(urlServer);
    return await response.json();
}

export async function getInstrumentoById(id:number){
    const urlServer = 'http://localhost/Back-Instrumentos/funciones.php?id='+id;
    const response = await fetch(urlServer);
    return await response.json() as Instrumento;
}
