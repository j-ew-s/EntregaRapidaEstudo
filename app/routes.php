<?php
# Index
$app->get("/", "BaseController:autenticate");

# Listagem
$app->get("/usuarios", "UsuariosController:getUsuarios");
$app->get("/usuarios/:search", "UsuariosController:getUsuarios");
# Create
$app->get("/usuarios/create", "UsuariosController:createUsuarios");
# Form Insert e Update
$app->post("/usuarios", "UsuariosController:addUsuarios");
$app->put("/usuarios/:id", "UsuariosController:updateUsuarios");
$app->delete("/usuarios/:id", "UsuariosController:deleteUsuarios");


# Listagem
$app->get("/empresas", "EmpresasController:getEmpresas");
$app->get("/empresas/:search", "EmpresasController:getEmpresas");

# Form Insert e Update
$app->post("/empresas", "EmpresasController:addEmpresas");
$app->put("/empresas/:id", "EmpresasController:updateEmpresas");
$app->delete("/empresas/:id", "EmpresasController:deleteEmpresas");