import { Route, Routes } from "react-router-dom"
import Instrumentos from "../components/instrumentos/Instrumentos"
import DetalleInstrumentos from "../components/detalleInstrumentos/DetalleInstrumentos"
import Home from "../components/home/Home"
import DondeEstamos from "../components/dondeEstamos/DondeEstamos"

const AppRoutes = () => {
  return (
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/products" element={<Instrumentos />} />
        <Route path="/products/detalle/:id" element={<DetalleInstrumentos />}/>
        <Route path="/DondeEstamos" element={<DondeEstamos />} />
      </Routes>

  )
}

export default AppRoutes