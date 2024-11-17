import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { Locations, Location } from 'react-router-component';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import './index.css'
import App from './App.jsx'
import AddProduct from './AddProduct.jsx'

createRoot(document.getElementById('root')).render(
	<BrowserRouter>
		<Routes>
			<Route index path="/" element={<App />} />
			<Route path="/add-product" element={<AddProduct />} />
		</Routes>
	</BrowserRouter>
)
