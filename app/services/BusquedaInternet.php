<?php

class BusquedaInternet
{
    public function buscarProducto($producto)
    {
        $producto = trim($producto);

        if ($producto === "") {
            return [];
        }

        /*
         * =====================================================
         * BUSCAR PRODUCTO EN ÉXITO
         * =====================================================
         */

        $consulta = urlencode($producto);

        $urlBusqueda =
            "https://www.exito.com/search?"
            . "q="
            . $consulta;

        $contexto = stream_context_create([
            "http" => [
                "method" => "GET",
                "header" =>
                    "User-Agent: Mozilla/5.0\r\n" .
                    "Accept: text/html,application/xhtml+xml\r\n",
                "timeout" => 3
            ]
        ]);

        $htmlBusqueda = @file_get_contents(
            $urlBusqueda,
            false,
            $contexto
        );

        if ($htmlBusqueda === false) {
            return [];
        }

        /*
         * =====================================================
         * BUSCAR URL DE PRODUCTO
         * =====================================================
         */

        $patronProducto =
            '/https:\/\/www\.exito\.com\/[^"\s]+\/p/';

        preg_match_all(
            $patronProducto,
            $htmlBusqueda,
            $coincidencias
        );

        if (
            empty($coincidencias[0])
        ) {
            return [];
        }

        /*
         * Eliminar URLs duplicadas
         */

        $urls = array_unique(
            $coincidencias[0]
        );

        /*
         * Tomar máximo 5 productos
         */

        $urls = array_slice(
            $urls,
            0,
            5
        );

        $resultados = [];

        /*
         * =====================================================
         * CONSULTAR CADA PRODUCTO
         * =====================================================
         */

        foreach ($urls as $url) {

            $html = @file_get_contents(
                $url,
                false,
                $contexto
            );

            if ($html === false) {
                continue;
            }

            /*
             * =================================================
             * PRECIO NORMAL
             * =================================================
             */

            $precioNormal = null;

            $posicion = stripos(
                $html,
                "ProductPrice_container__price"
            );

            if ($posicion !== false) {

                $fragmento = substr(
                    $html,
                    $posicion,
                    1000
                );

                if (
                    preg_match(
                        '/\$\s*.*?([0-9]{1,3}(?:\.[0-9]{3})*)/s',
                        $fragmento,
                        $coincidencia
                    )
                ) {

                    $precioNormal =
                        "$" . $coincidencia[1];
                }
            }

            /*
             * =================================================
             * PRECIO PROMOCIONAL
             * =================================================
             */

            $precioPromocion = null;

            $posicion = stripos(
                $html,
                "priceSection_container-promotion_price"
            );

            if ($posicion !== false) {

                $fragmento = substr(
                    $html,
                    $posicion,
                    1000
                );

                if (
                    preg_match(
                        '/\$\s*.*?([0-9]{1,3}(?:\.[0-9]{3})*)/s',
                        $fragmento,
                        $coincidencia
                    )
                ) {

                    $precioPromocion =
                        "$" . $coincidencia[1];
                }
            }

            /*
             * =================================================
             * NOMBRE DEL PRODUCTO
             * =================================================
             */

            $nombreProducto = $producto;

            if (
                preg_match(
                    '/<title>(.*?)<\/title>/is',
                    $html,
                    $coincidencia
                )
            ) {

                $nombreProducto =
                    trim(
                        strip_tags(
                            html_entity_decode(
                                $coincidencia[1]
                            )
                        )
                    );
            }

            /*
             * =================================================
             * GUARDAR RESULTADO
             * =================================================
             */

            $resultados[] = [

                "tienda" => "Éxito",

                "producto" => $nombreProducto,

                "url" => $url,

                "precio_normal" =>
                    $precioNormal,

                "precio_promocion" =>
                    $precioPromocion

            ];
        }

        return $resultados;
    }
}