<?php
namespace App\Http\Controllers;

use App\Models\Continent;

/**
 * Class CountryController
 * @package App\Http\Controllers
 */
class ContinentController extends Controller
{
    /**
     * @return Continent[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Continent::all();
    }
}
