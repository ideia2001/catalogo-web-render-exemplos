<?php

function obtemCookieIdioma()
{
  if (isset($_COOKIE['idioma'])) {
    $idm = $_COOKIE['idioma'];
  } else {
    $idm = '';
  }
  return $idm;
}

function cw_render()
{
  $chavePerfil = getenv('CHAVE_PERFIL');
  $chaveSecreta = getenv('CHAVE_SECRETA');
  $catalogo = getenv('CATALOGO');

  $DOMINIO_API = 'https://catalogoexpresso.com.br/ideia2001/render/v2/';

  $pathname = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  $querystring = $_SERVER['QUERY_STRING'];
  // idioma do site vai aqui, por exemplo
  $idm = 'pt';
  // se catálogo for multi-idioma via cookie
  // $idm = obtemCookieIdioma();

  // outro exemplo é obter o idioma do pathname
  // Verificar se o pathname começa com "/pt", "/en" ou "/es"
  if (preg_match('/^\/(pt|en|es)/', $pathname, $matches)) {
    $idm = $matches[1];
    $pathname = substr($pathname, 3); // Remove "/pt", "/en" ou "/es" do pathname
  }

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLINFO_HEADER_OUT => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
    ),
    // FIM OPÇÕES PARA POST
    CURLOPT_URL => $DOMINIO_API
      . '?retornoJson=1'
      . '&catalogo=' . $catalogo
      . '&chavePerfil=' . $chavePerfil
      . '&chaveSecreta=' . $chaveSecreta
      . '&pathname=' . $pathname
      . '&idioma=' . $idm
      . '&' . $querystring
  ]);

  $resp = curl_exec($curl);

  curl_close($curl);

  return json_decode($resp);
}
