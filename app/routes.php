<?php
# Index
$app->get("/", "BaseController:autenticate");

# Listagem
$app->get("/usuarios", "UsuariosController:getUsuarios");
$app->get("/usuarios/:search", "UsuariosController:getUsuarios");

# Form Insert e Update
$app->post("/usuarios", "UsuariosController:addUsuarios");
$app->put("/usuarios/:id", "UsuariosController:updateUsuarios");
$app->delete("/usuarios/:id", "UsuariosController:deleteUsuarios");