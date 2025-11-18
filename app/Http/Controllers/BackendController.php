<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    private $names = [
        1 => ['name' => 'Shrek', 'age' => 27],
        3 => ['name' => 'Woody', 'age' => 27],
        2 => ['name' => 'Alan', 'age' => 27],
    ];

    public function getAll()
    {
        return response()->json($this->names);
    }

    public function get(int $id = 0)
    {
        if (isset($this->names[$id])) {
            return response()->json($this->names[$id]);
        }
        return response()->json(["error" => "Persona no existente"], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $req)
    {

        $person = [
            "id" => count($this->names) + 1,
            "name" => $req->input("name"),
            "age" => $req->input("age"),
        ];


        $this->names[$person["id"]] = $person;

        return response()->json(["message" => "Persona creada", "person" => $person], Response::HTTP_CREATED);
    }

    public function update(Request $req, int $id)
    {
        if (isset($this->names[$id])) {

            $this->names[$id]["name"] = $req->input("name", $this->names[$id]["name"]);
            $this->names[$id]["age"] = $req->input("age");

            return response()->json(
                [
                    "message" => "Persona actualizada",
                    "person" => $this->names[$id]
                ],
                Response::HTTP_OK
            );
        }
        return response()->json(["error" => "Persona no existente"], Response::HTTP_NOT_FOUND);
    }

    public function delete($id)
    {
        if (isset($this->names[$id])) {
            unset($this->names[$id]);

            return response()->json(["message" => "Persona eliminada"]);
        }
        return response()->json(["error" => "Persona no existente"], Response::HTTP_NOT_FOUND);
    }
}
