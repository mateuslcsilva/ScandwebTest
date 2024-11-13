import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { Locations, Location } from 'react-router-component';
import './index.css'
import App from './App.jsx'
import AddProduct from './AddProduct.jsx'

createRoot(document.getElementById('root')).render(
    <Locations>
      <Location path="/" handler={App} />
      <Location path="/add-product" handler={AddProduct} />
    </Locations>
)
