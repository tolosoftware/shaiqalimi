// axios
import axios from 'axios'

const baseURL = 'http://localhost:8000/api/'

export default axios.create({
  baseURL
  // You can add your headers here
})
