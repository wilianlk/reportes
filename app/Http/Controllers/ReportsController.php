<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
    public function index()
    {
        // se validara git
        $users = DB::select("SELECT c.id_cliente,
concat(IFNULL(c.nombre,''),' ',
IFNULL(c.apellido,'')) AS nombre_cliente,
if(c.mayorista,'CALLCENTER','SUCURSAL') AS origen,
c.origen_ficha,
 IFNULL(gi.nombre,'NO DEFINIDO') AS idioma,
 ct.nombre AS tipo_cliente,
 tc.nombre AS estado_compra,
 z.zip_code,
 ci.ciudad ,
 ci.estado AS pais_estado,
 ci.pais AS pais,g.nombre_grupo AS grupo_ventas,
 g.nombre_grupo AS filtro_grupo_ventas,
 if(c.mayorista,'CALLCENTER','SUCURSAL') AS origen,
 if(c.mayorista,'CALLCENTER','SUCURSAL') AS filtro_origen,
 c.origen_ficha AS filtro_origen_ficha,
 ci.estado AS filtro_pais_estado,
 ci.pais AS filtro_pais,
 ct.nombre AS filtro_tipo_cliente,
  YEAR(c.created_at) AS anio,
   MONTH(c.created_at) AS mes,
	 WEEK(c.created_at) AS semana,
	 i.tipo AS tipo_telefono,
	 i.numero AS numero_telefono,
	 i.extension,
	 i.autoriza_sms,
	 i.email,
	 1 AS cantidad,
	 cmc.nombre AS medio_conocimiento,
                   CONCAT(sc.first_name,' ',sc.last_name) creado_por
FROM cliente c
INNER JOIN sf_guard_user sc ON sc.id = c.created_by
LEFT JOIN cli_grupo_ventas cg ON c.id_cliente=cg.id_cliente
LEFT JOIN grupo_ventas g ON cg.id_grupo_ventas=g.id_grupo_ventas
LEFT JOIN cli_medio_conocimiento cmc ON c.id_medio_conocimiento = cmc.id_medio_conocimiento
LEFT JOIN z_ciudad_prim_cli z ON c.id_cliente=z.id_cliente
LEFT JOIN Z_ciudad_estado_pais ci ON z.id_ciudad=ci.id_ciudad
LEFT JOIN cli_tipo ct ON c.id_tipo_cliente=ct.id_tipo_cliente
LEFT JOIN gen_tipo_compra tc ON c.id_tipo_compra=tc.id_tipo_compra
LEFT JOIN gen_idioma gi ON c.id_idioma=gi.id_idioma
LEFT JOIN (
SELECT c1.id_cliente,t.tipo,t.numero,t.extension,if(t.autoriza_sms,'SI','NO')autoriza_sms,c1.email
FROM cliente c1
INNER JOIN cli_telefono t ON c1.id_cliente=t.id_cliente
GROUP BY c1.id_cliente UNION
SELECT cc.id_cliente,ctl.tipo,ctl.numero,ctl.extension,if(ctl.autoriza_sms,'SI','NO')autoriza_sms,cc.email
FROM cli_contacto cc
INNER JOIN cli_telefono_contacto ctl ON cc.id_cliente_contacto=ctl.id_cliente_contacto
GROUP BY cc.id_cliente)i ON c.id_cliente=i.id_cliente
WHERE (c.mayorista=1 AND c.origen_ficha IS NULL) OR (c.mayorista=1 AND c.origen_ficha='USA') OR (cg.id_grupo_ventas IS NOT NULL AND (c.mayorista=1 OR c.mayorista=0))
AND c.id_status <> 0
GROUP BY c.id_cliente");
        return response()->json($users);
    }
 public function testfelipe()
    {
        
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
