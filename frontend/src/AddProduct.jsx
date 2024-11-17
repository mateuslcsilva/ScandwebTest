import { useState, useReducer, useEffect } from 'react'
import { Link, useNavigate  } from "react-router-dom";
import './App.css'

const initialFormState = {
	sku: "",
	name: "",
	price: "",
	type: "",
	dimensions: {
		height: "",
		width: "",
		length: ""
	},
	size: "",
	weight: ""
};

const typeNames = {
	'D': "DVD",
	'B': 'Book',
	'F': 'Furniture'
};

const formReducer = (state, action) => {
	switch (action.type) {
		case "HANDLE INPUT TEXT":
			return {
				...state,
				[action.field]: action.payload,
			}
		case "TOGGLE CONSENT":
			return {
				...state,
				hasConsented: !state.hasConsented,
			}
		case "HANDLE DIMENSIONS CHANGE":
			let changes = {
				...state.dimensions, 
				[action.field]: action.payload
			}
			console.log(changes)
			return {
				...state,
				dimensions: changes,
			}
		default:
			return state;
	}
}

function AddProduct() {
	const [state, dispatch] = useReducer(formReducer, initialFormState);
	const [typeListActive, setTypeListActive] = useState(false)
	const navigate = useNavigate();

	useEffect(() => {
		console.log(state)
	}, [state])

	const handleTextChange = (e) => {
		dispatch({
			type: "HANDLE INPUT TEXT",
			field: e.target.name,
			payload: e.target.value,
		})
	}

	const handleDimensionsChange = (e) => {
		dispatch({
			type: "HANDLE DIMENSIONS CHANGE",
			field: e.target.name,
			payload: e.target.value,
		})
	}

	const setType = (value) => {
		dispatch({ type: "HANDLE INPUT TEXT", field: "type", payload: value });
		setTypeListActive(false)
	}

	const saveProduct = async () => {
		const data = {
			sku: state.sku,
			name: state.name,
			price: state.price,
			type: state.type
		}

		if(state.type == 'B'){
			data.weight = state.weight
		}

		if(state.type == 'D'){
			data.size = state.size
		}

		if(state.type == 'F'){
			for (const key in state.dimensions) {
				if(state.dimensions[key] == ''){
					return alert("Please, submit required data")
				}
			}
			data.dimensions = `${state.dimensions.height}X${state.dimensions.width}X${state.dimensions.length}`
		}

		for (const key in data) {
			if(data[key] == ''){
				return alert("Please, submit required data")
			}
		}

		const requestOptions = {
			method: 'POST',
			header : "Content-type: application/json",
			body: JSON.stringify(data)
		}
		await fetch('https://teste.lcsilva.cloud/scandiweb_test/product/save', requestOptions)
		.then(res => {
			console.log(res)
			return res.json()
		})
		.then(res => {
			console.log(res);
			if(res.error == true){
				return alert(res.message)
			}
			navigate("..", { relative: 'path' });
			return;
		})
	}
	return (
		<main>
			<header>
				<h1>Add Product</h1>
				<div className="actions">
					<button className='button button-success' onClick={saveProduct}>Save</button>
					<button className='button button-cancel'>
						<Link to=".." relative="path">Cancel</Link>
					</button>
				</div>
			</header>
			<hr />
			<form className="input-container" id="product_form">
				<div className="ordinary-input-div">
					<input
						type="text"
						className="ordinary-input-input input-large input-text"
						autoComplete='off'
						onChange={(e) => handleTextChange(e)}
						value={state.sku}
						name="sku"
						id="sku"
						required
					/>
					<label htmlFor="sku" className="ordinary-input-label">Sku</label>
				</div>
				<div className="ordinary-input-div">
					<input
						type="text"
						className="ordinary-input-input input-large input-text"
						autoComplete='off'
						onChange={(e) => handleTextChange(e)}
						value={state.name}
						name="name"
						id="name"
						required
					/>
					<label htmlFor="name" className="ordinary-input-label">Name</label>
				</div>
				<div className="ordinary-input-div">
					<input
						type="text"
						className="ordinary-input-input input-large input-text"
						autoComplete='off'
						onChange={(e) => handleTextChange(e)}
						value={state.price}
						name="price"
						id="price"
						required
					/>
					<label htmlFor="price" className="ordinary-input-label">Price</label>
				</div>

{/* 				<section>
					<div
						className={`typesInput ${typeListActive ? "active-input" : ""}`}
						placeholder="Select Product Type"
						onClick={() => setTypeListActive(typeListActive => !typeListActive)}
						id="productType"
					>
						<p>{state.type ? typeNames[state.type] : "Product Type"}</p>
					</div>

					<div id='typeList' className={typeListActive ? "active primary-text" : "primary-text"}>
						<input
							type="button"
							className="user-type-button"
							name="userType"
							value="DVD"
							id="DVD"
							onClick={() => setType('D')}
						/>
						<input
							type="button"
							className="user-type-button"
							name="userType"
							value="Furniture"
							id="Furniture"
							onClick={() => setType('F')}
						/>
						<input
							type="button"
							className="user-type-button"
							name="userType"
							value="Book"
							id="Book"
							onClick={() => setType('B')}
						/>
					</div>
				</section> */}
				<div class="select">
					<select class="standard-select" onChange={(e) => setType(e.target.value)} name="type" id="productType">
						<option value="D" id="DVD">DVD</option>
						<option value="B" id="Book">Book</option>
						<option value="F" id="Furniture">Furniture</option>
					</select>
					<span class="focus"></span>
				</div>
				{state.type == 'D' &&
					<div className='input-container' style={{ marginTop: '30px' }}>
						<div className="ordinary-input-div">
							<input
								type="text"
								className="ordinary-input-input input-large input-text"
								autoComplete='off'
								onChange={(e) => handleTextChange(e)}
								value={state.size}
								name="size"
								id="size"
								required
							/>
							<label htmlFor="size" className="ordinary-input-label">Size (MB)</label>
							<span>Please, provide dvd disc size in MB.</span>
						</div>
					</div>
				}
				{state.type == 'B' &&
					<div className='input-container' style={{ marginTop: '30px' }}>
						<div className="ordinary-input-div">
							<input
								type="text"
								className="ordinary-input-input input-large input-text"
								autoComplete='off'
								onChange={(e) => handleTextChange(e)}
								value={state.weight}
								name="weight"
								id="weight"
								required
							/>
							<label htmlFor="weight" className="ordinary-input-label">Weight (KG)</label>
							<span>Please, provide book weight in KG.</span>
						</div>
					</div>
				}
				{state.type == 'F' &&
					<div className='input-container' style={{ marginTop: '30px' }}>
						<div className="ordinary-input-div">
							<input
								type="text"
								className="ordinary-input-input input-large input-text"
								autoComplete='off'
								onChange={(e) => handleDimensionsChange(e)}
								value={state.dimensions.height}
								name="height"
								id="height"
								required
							/>
							<label htmlFor="height" className="ordinary-input-label">Height (CM)</label>
						</div>
						<div className="ordinary-input-div">
							<input
								type="text"
								className="ordinary-input-input input-large input-text"
								autoComplete='off'
								onChange={(e) => handleDimensionsChange(e)}
								value={state.dimensions.width}
								name="width"
								id="width"
								required
							/>
							<label htmlFor="width" className="ordinary-input-label">Width (CM)</label>
						</div>
						<div className="ordinary-input-div">
							<input
								type="text"
								className="ordinary-input-input input-large input-text"
								autoComplete='off'
								onChange={(e) => handleDimensionsChange(e)}
								value={state.dimensions.length}
								name="length"
								id="length"
								required
							/>
							<label htmlFor="length" className="ordinary-input-label">Length (CM)</label>
							<span>Please, provide dimensions in HxWxL format.</span>
						</div>
					</div>
				}
			</form>
		</main>
	)
}

export default AddProduct
