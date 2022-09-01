<?php
namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
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
            'continent' => [
                'nullable',
                Rule::in(Continent::all()->pluck('code')->toArray())
            ],
        ]);

        $countries = Country::orderBy(
            $request->get('orderBy', 'display_order'),
            $request->get('order', 'ASC')
        );

        if ($request->get('continent')) {
            $countries->whereHas('continent', function (Builder $query) use ($request) {
                $query->where('code', $request->get('continent'));
            });
        }

        return $countries->paginate(10);
    }
}
