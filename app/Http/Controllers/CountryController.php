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

    /**
     * @param Country $country
     * @return Country
     */
    public function show(Country $country): Country
    {
        return $country;
    }

    /**
     * @param Request $request
     * @param int $country
     * @return Country
     */
    public function updateOrCreate(Request $request, int $country = 0): Country
    {
        $uniqueCodeRule = Rule::unique('countries', 'code');
        if ($country) {
            $uniqueCodeRule->ignore($country, 'country_id');
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'full_name' => 'required|string',
            'code' => [
                'required',
                'string',
                'size:2',
                $uniqueCodeRule
            ],
            'number' => 'required|numeric|min:1|max:999',
            'iso3' => 'required|string|size:3',
            'display_order' => 'required|numeric|min:0|max:999',
            'continent_code' => [
                'required',
                'string',
                'size:2',
                Rule::in(Continent::all()->pluck('code')->toArray())
            ]
        ]);

        return Country::updateOrCreate([
            'country_id' => $country
        ], $validated);
    }
}
