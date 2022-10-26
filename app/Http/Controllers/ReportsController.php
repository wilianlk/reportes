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
        $users = DB::select("
                            SELECT cs.id_cliente,IF(IFNULL(cs.cliente_exist,2) = 1,'Cliente Existente','Cliente No Existente') creacion_cliente,CONCAT(c.nombre,' ',c.apellido) name_client,IFNULL(ct.nombre,ct2.nombre) tipo_cliente,cs.telefono,cs.email,
                            cs.aplicacion,t.nombre tiendas,
                            DAY(cs.created_at) dia_numero,DAYNAME(cs.created_at) dia_nombre_eng,
                            CASE DAYOFWEEK(cs.created_at)
                                WHEN 1 THEN 'Domingo'
                                WHEN 2 THEN 'Lunes'
                                WHEN 3 THEN 'Martes'
                                WHEN 4 THEN 'Miércoles'
                                WHEN 5 THEN 'Jueves'
                                WHEN 6 THEN 'Viernes'
                                WHEN 7 THEN 'Sábado'
                            END nombre_dia_es,DAYOFWEEK(cs.created_at) dia_semana,WEEKOFYEAR(cs.created_at) numero_semana,
                            MONTH(cs.created_at) mes,
                            CASE MONTH(cs.created_at)
                                WHEN 1 THEN 'Enero'
                                WHEN 2 THEN  'Febrero'
                                WHEN 3 THEN 'Marzo'
                                WHEN 4 THEN 'Abril'
                                WHEN 5 THEN 'Mayo'
                                WHEN 6 THEN 'Junio'
                                WHEN 7 THEN 'Julio'
                                WHEN 8 THEN 'Agosto'
                                WHEN 9 THEN 'Septiembre'
                                WHEN 10 THEN 'Octubre'
                                WHEN 11 THEN 'Noviembre'
                                WHEN 12 THEN 'Diciembre'
                            END mes_nombre,YEAR(cs.created_at) ano,
                            CONCAT(s.first_name,' ',s.last_name) quien_envio,ud.nombre departamento_pertenece,
                            cs.voucher,cs.descuento,cs.uso,cs.codigo
                            FROM cli_juego_scrach_configuracion cs
                            LEFT JOIN cliente c ON c.id_cliente = cs.id_cliente
                            LEFT JOIN cli_tipo ct ON ct.id_tipo_cliente = cs.tipo_cliente
                            LEFT JOIN cli_tipo ct2 ON ct2.id_tipo_cliente = c.id_tipo_cliente
                            LEFT JOIN tienda t ON t.id_tienda = cs.id_tienda_juego
                            LEFT JOIN sf_guard_user s ON s.id = cs.id_user
                            LEFT JOIN user_departamento ud ON ud.id_user_departamento = s.id_user_departamento
                            WHERE 1
                            ORDER BY
                            (CASE
                                WHEN cs.aplicacion = 'callcenterusa' THEN 1
                                WHEN cs.aplicacion = 'sucursales' THEN 2
                            END) ASC");

        return response()->json($users);
    }

    public function testfelipef()
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
