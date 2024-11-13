import { useEffect, useState } from 'react'
import './App.css'

function AddProduct() {

	const getProducts = async () => {
		await fetch('https://teste.lcsilva.cloud/scandiweb_test/product/fetch')
		.then(res => res.json())
		.then(res => {
			console.log(res);
			if(res.error == false){
                //
			}
		})
	}
	return (
		<main>
			<header>
				<h1>Add Productaaaaaaaa</h1>
				<div className="actions">
					<button>Save</button>
				</div>
			</header>
			<hr />
		</main>
	)
}

export default AddProduct
