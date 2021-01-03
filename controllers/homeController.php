<?php

    class homeController extends Controller
    {
        public function index()
        {
            $anuncios = new Anuncio;
            $usuarios = new Usuario;

            $dados = [];

            $this->loadTemplate('home', $dados);
        }
    }
