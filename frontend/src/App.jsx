import { useEffect, useState } from 'react'
import { Link } from "react-router-dom";
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function App() {
	const [products, setProducts] = useState([]);
	const [selectedProducts, setSelectedProducts] = useState([]);

	useEffect(() => {
		getProducts();
	}, [])

	const getProducts = async () => {
		await fetch('https://teste.lcsilva.cloud/scandiweb_test/product/fetch')
		.then(res => res.json())
		.then(res => {
			console.log(res);
			if(res.error == false){
				setProducts(res.products);
			}
		})
	}

	const selectProducts = (productSku) => {
		if(event.target.checked){
			return setSelectedProducts(selectProducts => [...selectProducts, productSku])
		}
		setSelectedProducts(selectProducts => selectProducts.filter(sku => sku != productSku))
	}

	const massDelete = async () => {
		const requestOptions = {
			method: 'DELETE',
			body: JSON.stringify({
				skus: selectedProducts
			})
		}
		console.log('request options', requestOptions)
		await fetch('https://teste.lcsilva.cloud/scandiweb_test/product/massDelete', requestOptions)
		.then(res => res.json())
		.then(async (res) => {
			console.log(res);
			await getProducts();
			if(res.error == false){
				//setProducts(res.products);
			}
		})
	}

	const getLabel = (product) => {
		if(product?.size) return "Size"
		if(product?.weight) return "Weight"
		if(product?.dimensions) return "Dimensions"
	}

	return (
		<main>
			<header>
				<h1>Product List</h1>
				<div className="actions">
					<button className='button'>
						<Link to={'/add-product'} relative='path'>ADD</Link>
					</button>
					<button id="delete-product-btn" className='button button-danger' onClick={massDelete}>Mass Delete</button>
				</div>
			</header>
			<hr />
			<div className="products-container">
				{products?.map(product => {
					return (
						<div className="product" key={'product' + product.sku}>
							<input onChange={() => selectProducts(product.sku)} className="delete-checkbox" type="checkbox" id="deleteCheckbox" />
							<span>{product.sku}</span>
							<span>{product.name}</span>
							<span>{getLabel(product)}: {product?.dimensions || product?.weight || product?.size}</span>
							<span>$ {product.price}</span>
						</div>
					)
				})}
			</div>
		</main>
	)
}

export default App
