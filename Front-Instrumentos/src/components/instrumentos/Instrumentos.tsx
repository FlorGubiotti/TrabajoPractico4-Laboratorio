import { useEffect, useState } from "react";
import Instrumento from "../../entities/Instrumento";
import { getAllInstrumentos } from "../../services/InstrumentosService";
import './Instrumentos.css';
import { Link } from "react-router-dom";

const Instrumentos = () => {

    const [instrumentos, setInstrumentos] = useState<Instrumento[]>([]);

    useEffect(() => {
        const fetchData = async () => {
            const instrumentosData = await getAllInstrumentos();
            setInstrumentos(instrumentosData);
            console.log(instrumentosData);
        };
        fetchData();
    }, []);

    return (
        <div className="container">
            {instrumentos.map((instrumento) => (
                    <div className="card mb-3" style={{ maxWidth: '540px' }}>
                        <div className="row g-0">
                            <div className="col-md-4 d-flex align-items-center justify-content-center">
                                <img src={"/images/" + instrumento.imagen} className="img-fluid rounded-start" alt={instrumento.instrumento} />
                            </div>
                            <div className="col-md-8">
                                <div className="card-body">
                                    <h5 className="card-title">{instrumento.instrumento}</h5>
                                    <p className="card-text"> $ {instrumento.precio}</p>
                                    <p className={`card-text ${instrumento.costoEnvio === 'G' ? 'text-success' : 'text-warning'}`}>
                                        {instrumento.costoEnvio === 'G' && <img src={"/images/camion.png"} alt="Envío Gratis" />} {instrumento.costoEnvio === 'G' ? 'Envío gratis a todo el país' : `Costo de Envío Interior de Argentina: $${instrumento.costoEnvio}`}
                                    </p>
                                    <p className="card-text"><small className="text-body-secondary">{instrumento.cantidadVendida} vendidos</small></p>
                                    <Link to={`/products/detalle/${instrumento.id}`} className="btn btn-primary">Ver Detalle</Link>
                                </div>
                            </div>
                        </div>
                    </div>
            ))}
        </div>
    )
}

export default Instrumentos;
