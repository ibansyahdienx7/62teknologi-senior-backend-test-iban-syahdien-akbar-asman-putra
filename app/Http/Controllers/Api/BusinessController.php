<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Business;
use App\Traits\MyHelper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    use MyHelper;

    function Search($term, $category, $sort_by, $locale, $radius)
    {
        $search = Business::where('term', 'like', '%' . $term . '%')
            ->where('categories', 'like', '%' . $category . '%')
            ->where('sort_by', 'like', '%' . $sort_by . '%')
            ->where('locale', 'like', '%' . $locale . '%')
            ->where('radius', 'like', '%' . $radius . '%')
            ->get();

        if (count($search) > 0) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'msg' => 'Available Data',
                'data' => $search,
                'error' => 0
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'status' => false,
            'msg' => 'Search not found',
            'error' => 1
        ], 404);
    }
    function Store()
    {
        $location                   = request()->location;
        $latitude                   = request()->lat;
        $longtitude                 = request()->long;
        $term                       = request()->term;
        $radius                     = request()->radius;
        $categories                 = request()->categories;
        $locale                     = request()->locale;
        $price                      = request()->price;
        $open_now                   = request()->open_now;
        $open_at                    = request()->open_at;
        $attributes                 = request()->attribute;
        $sort_by                    = request()->sort_by;
        $device_platform            = request()->device_platform;
        $reservation_date           = request()->reservation_date;
        $reservation_time           = request()->reservation_time;
        $reservation_covers         = request()->reservation_covers;
        $matches_party_size_param   = request()->matches_party_size_param;
        $limit                      = request()->limit;
        $offset                     = request()->offset;

        $validation = Validator::make(request()->all(), [
            'location'                  => 'required|string|max:250|min:1',
            'lat'                       => 'required|max:90|min:1',
            'long'                      => 'required|max:180|min:1',
            'term'                      => 'required|string',
            'radius'                    => 'required|integer|max:40000|min:0',
            'categories'                => 'required|string|min:1',
            'locale'                    => 'required|string',
            'price'                     => 'required|integer|min:1',
            'open_now'                  => 'required|string',
            'open_at'                   => 'required|date',
            'attribute'                 => 'required|string',
            'sort_by'                   => 'required|string',
            'device_platform'           => 'required|string',
            'reservation_date'          => 'required|string',
            'reservation_time'          => 'required|string',
            'reservation_covers'        => 'required|integer|max:10|min:1',
            'matches_party_size_param'  => 'required|string',
            'limit'                     => 'required|integer|max:50|min:0',
            'offset'                    => 'required|integer|max:1000|min:0'
        ]);

        // validate request
        if ($validation->fails()) {
            $json = [
                'code'          => 422,
                'status'        => false,
                'msg'           => 'Bad Request!',
                'error'         => 1,
                'error_detail'  => $validation->errors()
            ];

            return response()->json($json, $json['code']);
        }

        try {
            $checkBusiness = Business::where('term', $term)
                ->where('latitude', $latitude)
                ->where('longtitude', $longtitude)
                ->first();
            if ($checkBusiness) {
                return response()->json([
                    'code'      => 419,
                    'status'    => false,
                    'msg'       => 'Data is Available',
                    'data'      => $checkBusiness,
                    'error'     => 1
                ], 419);
            }

            $create = Business::create([
                'location'                  => $location,
                'latitude'                  => $latitude,
                'longtitude'                => $longtitude,
                'term'                      => $term,
                'radius'                    => $radius,
                'categories'                => $categories,
                'locale'                    => $locale,
                'price'                     => $price,
                'open_now'                  => $open_now == 'true' ? 1 : 0,
                'open_at'                   => strtotime($open_at),
                'attributes'                => $attributes,
                'sort_by'                   => $sort_by,
                'device_platform'           => $device_platform,
                'reservation_date'          => $reservation_date,
                'reservation_time'          => $reservation_time,
                'reservation_covers'        => $reservation_covers,
                'matches_party_size_param'  => $matches_party_size_param == 'true' ? 1 : 0,
                'limit'                     => $limit,
                'offset'                    => $offset,
                'created_at'                => now(),
                'updated_at'                => now()
            ]);

            return response()->json([
                'code'      => 200,
                'status'    => true,
                'msg'       => 'Data store is completed',
                'data'      => $create,
                'error'     => 0
            ], 200);
        } catch (QueryException $error) {
            return response()->json([
                'code'          => 417,
                'status'        => false,
                'msg'           => 'Oopss !! Something was wrong',
                'error'         => 1,
                'error_detail'  => $error
            ], 417);
        }
    }

    function Update()
    {
        $id                         = request()->id;
        $location                   = request()->location;
        $latitude                   = request()->lat;
        $longtitude                 = request()->long;
        $term                       = request()->term;
        $radius                     = request()->radius;
        $categories                 = request()->categories;
        $locale                     = request()->locale;
        $price                      = request()->price;
        $open_now                   = request()->open_now;
        $open_at                    = request()->open_at;
        $attributes                 = request()->attribute;
        $sort_by                    = request()->sort_by;
        $device_platform            = request()->device_platform;
        $reservation_date           = request()->reservation_date;
        $reservation_time           = request()->reservation_time;
        $reservation_covers         = request()->reservation_covers;
        $matches_party_size_param   = request()->matches_party_size_param;
        $limit                      = request()->limit;
        $offset                     = request()->offset;

        $validation = Validator::make(request()->all(), [
            'id'                        => 'required|integer',
            'location'                  => 'required|string|max:250|min:1',
            'lat'                       => 'required|max:90|min:1',
            'long'                      => 'required|max:180|min:1',
            'term'                      => 'required|string',
            'radius'                    => 'required|integer|max:40000|min:0',
            'categories'                => 'required|string|min:1',
            'locale'                    => 'required|string',
            'price'                     => 'required|integer|min:1',
            'open_now'                  => 'required|string',
            'open_at'                   => 'required|date',
            'attribute'                 => 'required|string',
            'sort_by'                   => 'required|string',
            'device_platform'           => 'required|string',
            'reservation_date'          => 'required|string',
            'reservation_time'          => 'required|string',
            'reservation_covers'        => 'required|integer|max:10|min:1',
            'matches_party_size_param'  => 'required|string',
            'limit'                     => 'required|integer|max:50|min:0',
            'offset'                    => 'required|integer|max:1000|min:0'
        ]);

        // validate request
        if ($validation->fails()) {
            $json = [
                'code'          => 422,
                'status'        => false,
                'msg'           => 'Bad Request!',
                'error'         => 1,
                'error_detail'  => $validation->errors()
            ];

            return response()->json($json, $json['code']);
        }

        try {
            $checkBusiness = Business::where('id', $id)
                ->first();
            if (empty($checkBusiness)) {
                return response()->json([
                    'code'      => 404,
                    'status'    => false,
                    'msg'       => 'Data not found',
                    'error'     => 1
                ], 404);
            }

            $create = $checkBusiness->update([
                'location'                  => $location,
                'latitude'                  => $latitude,
                'longtitude'                => $longtitude,
                'term'                      => $term,
                'radius'                    => $radius,
                'categories'                => $categories,
                'locale'                    => $locale,
                'price'                     => $price,
                'open_now'                  => $open_now == 'true' ? 1 : 0,
                'open_at'                   => strtotime($open_at),
                'attributes'                => $attributes,
                'sort_by'                   => $sort_by,
                'device_platform'           => $device_platform,
                'reservation_date'          => $reservation_date,
                'reservation_time'          => $reservation_time,
                'reservation_covers'        => $reservation_covers,
                'matches_party_size_param'  => $matches_party_size_param == 'true' ? 1 : 0,
                'limit'                     => $limit,
                'offset'                    => $offset
            ]);

            return response()->json([
                'code'      => 200,
                'status'    => true,
                'msg'       => 'Data update is successfully',
                'data'      => $checkBusiness,
                'error'     => 0
            ], 200);
        } catch (QueryException $error) {
            return response()->json([
                'code'          => 417,
                'status'        => false,
                'msg'           => 'Oopss !! Something was wrong',
                'error'         => 1,
                'error_detail'  => $error
            ], 417);
        }
    }

    function Delete()
    {
        $id                         = request()->id;

        $validation = Validator::make(request()->all(), [
            'id'                        => 'required|integer',
        ]);

        // validate request
        if ($validation->fails()) {
            $json = [
                'code'          => 422,
                'status'        => false,
                'msg'           => 'Bad Request!',
                'error'         => 1,
                'error_detail'  => $validation->errors()
            ];

            return response()->json($json, $json['code']);
        }

        try {
            $checkBusiness = Business::where('id', $id)
                ->first();
            if (empty($checkBusiness)) {
                return response()->json([
                    'code'      => 404,
                    'status'    => false,
                    'msg'       => 'Data not found',
                    'error'     => 1
                ], 404);
            }

            $create = $checkBusiness->delete();

            return response()->json([
                'code'      => 200,
                'status'    => true,
                'msg'       => 'Data delete is successfully',
                'error'     => 0
            ], 200);
        } catch (QueryException $error) {
            return response()->json([
                'code'          => 417,
                'status'        => false,
                'msg'           => 'Oopss !! Something was wrong',
                'error'         => 1,
                'error_detail'  => $error
            ], 417);
        }
    }
}
