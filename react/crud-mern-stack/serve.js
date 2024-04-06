const express = require('express')
const app = express()

// Importar conexion
const archivoBD = require('./conexion')

// Importacion del archivo rutas y modelo susuario
const rutausuario = require('./rutas/usuario')

// Importando body-parser
const bodyParser = require('body-parser')
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended:'true'}))

app.use('/api/usuario', rutausuario)

app.get('/', (req, res) => {
    res.end('Bienvenidos al servidor backend Node.js corriendo....')
})

// Configurar server basico
app.listen(5000, function(){
    console.log('El servidor NODE esta corriendo')
})


// 43--04

// 54-30

// 1-53-11

// 2-06-21

// 2-12-37

// 2-24-6