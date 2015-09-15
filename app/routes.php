<?php
# Index
$app->get("/", "BaseController:autenticate");

# Listagem
$app->get("/usuario", "UsuarioController:getUsuario");
$app->get("/usuario/:search", "UsuarioController:getUsuario");
# Create
$app->get("/usuario/create", "UsuarioController:createUsuario");
# Form Insert e Update
$app->post("/usuario", "UsuarioController:addUsuario");
$app->put("/usuario/:id", "UsuarioController:updateUsuario");
$app->delete("/usuario/:id", "UsuarioController:deleteUsuario");


# Listagem
$app->get("/empresa", "EmpresaController:getEmpresa");
$app->get("/empresa/:search", "EmpresaController:getEmpresa");

# Form Insert e Update
$app->post("/empresa", "EmpresaController:addEmpresa");
$app->put("/empresa/:id", "EmpresaController:updateEmpresa");
$app->delete("/empresa/:id", "EmpresaController:deleteEmpresa");

# LISTAGEM

$app->get("/produto/", "ProdutoController:getProduto");

# Form Insert e Update
$app->post("/produto", "ProdutoController:addProduto");
$app->put("/produto/:id", "ProdutoController:updateProduto");
$app->delete("/produto/:id", "ProdutoController:deleteProduto");