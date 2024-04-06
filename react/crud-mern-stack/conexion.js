const mongoose = require('mongoose');
mongoose.connect('mongodb://127.0.0.1:27017/prueba');

const objetobd = mongoose.connection

objetobd.on('connected', () => {
    console.log('Conexion exitosaaa a MongoDB')
})

objetobd.on('error', () => {
    console.log('Conexion fallida a MongoDB')
})

module.exports = mongoose


