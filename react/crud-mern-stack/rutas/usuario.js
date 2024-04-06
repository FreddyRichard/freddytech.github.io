const express = require('express')
const router = express.Router()

const mongoose = require('mongoose')
const eschema = mongoose.Schema

const eschemausuario = new eschema({
    nombres: String,
    email: String,
    telefono: String,
    idusuario: String
})

const ModeloUsuario = mongoose.model('usuarios', eschemausuario)
//module.exports = ModeloUsuario; //aquie estaba router 1-15-2  ModeloUsuario
module.exports = router

// router.get('/ejemplo', (req, res) => {
//     res.end('saludosss')
// })


// Agregar Usuario
// router.post('/agregarusuario', (req, res) => {
//     const nuevousuario = new ModeloUsuario({
//         nombres: req.body.nombres,
//         email: req.body.email,
//         telefono: req.body.telefono,
//         idusuario: req.body.idusuario
//     })
//     nuevousuario.save(function(err) {
//         if(!err) {
//             res.send('Usuario agregado correctamente')
//         }else{
//             console.log(err);
//             res.send(err)
//         }
//     })
// })


// Agregar Usuario
router.post('/agregarusuario', (req, res) => {
    const nuevousuario = new ModeloUsuario({
        nombres: req.body.nombres,
        email: req.body.email,
        telefono: req.body.telefono,
        idusuario: req.body.idusuario
    });

    nuevousuario.save()
        .then(result => {
            res.send('Usuario agregado correctamente');
        })
        .catch(error => {
            res.send(error);
        });
});


// LISTAR USUARIOS  
// router.get('/obtenerususuarios', (req, res) => {
//     ModeloUsuario.find({}, function(docs, err) {
//         if (!err) {
//             res.send(docs)
//         } else {
//             res.send(err)
//         }
//     })
// })


// OBTENER TODOS LOS USUARIOS 
router.get('/obtenerusuarios', (req, res) => {
    ModeloUsuario.find()
        .then(docs => {
            res.send(docs);
        })
        .catch(error => {
            res.send(error);
        });
});


// OBTENER DATA DEL USUARIO 
router.post('/obtenerdatausuario', async (req, res) => {
    try {
        const docs = await ModeloUsuario.find({ idusuario: req.body.idusuario });
        res.send(docs);
    } catch (err) {
        res.status(500).send(err);
    }
});

// Actualizar Usuario
// router.post('/actualizausuario', (req, res) => {
//     ModeloUsuario.findOneAndUpdate({idusuario:req.body.idusuario}, {
//         nombres: req.body.nombres,
//         email: req.body.email,
//         telefono: req.body.telefono
//     }, (err) => {
//         if (!err) {
//             res.send('Usuario actualizado correctamente')
//         } else {
//             res.send(err)
//         }
//     })
// });
router.post('/actualizausuario', async (req, res) => {
    try {
        const updatedUser = await ModeloUsuario.findOneAndUpdate(
            { idusuario: req.body.idusuario },
            {
                nombres: req.body.nombres,
                email: req.body.email,
                telefono: req.body.telefono
            }
        );

        if (updatedUser) {
            res.send('Usuario actualizado correctamente');
        } else {
            res.send('No se encontró el usuario para actualizar');
        }
    } catch (err) {
        res.status(500).send(err.message || 'Error al actualizar el usuario');
    }
});


// Borrar Usuario
// router.post('/borrarusuario', (req, res) => {
//     ModeloUsuario.findOneAndDelete({idusuario:req.body.idusuario}, (err) => {
//         if (!err) {
//             res.send('Usuario eliminado correctamente')
//         } else {
//             res.send(err)
//         }
//     })
// });
router.post('/borrarusuario', async (req, res) => {
    try {
        const deletedUser = await ModeloUsuario.findOneAndDelete({ idusuario: req.body.idusuario });

        if (deletedUser) {
            res.send('Usuario eliminado correctamente');
        } else {
            res.send('No se encontró el usuario para eliminar');
        }
    } catch (err) {
        res.status(500).send(err.message || 'Error al eliminar el usuario');
    }
});
