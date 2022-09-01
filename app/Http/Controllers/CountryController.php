<?php
namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

/**
 * Class CountryController
 * @package App\Http\Controllers
 */
class CountryController extends Controller
{
    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $request->validate([
            'orderBy' => [
                'nullable',
                Rule::in(Schema::getColumnListing('countries'))
            ],
            'order' => [
                'nullable',
                Rule::in(['ASC', 'DESC'])
            ],
        ]);

        return Country::orderBy(
            $request->get('orderBy', 'display_order'),
            $request->get('order', 'ASC')
        )->paginate(10);
    }
}
