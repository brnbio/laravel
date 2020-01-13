{!! '<' . '?php' !!}

declare(strict_types=1);

namespace App\Http\Controllers\{{ $namespace }};

use App\Http\Controllers\Controller;
use App\Models\{{ $modelNamespace }};
use Illuminate\View\View;

/**
 * Class DetailsController
 * {{ '@' . 'package App\Http\Controllers\\' . $namespace }}
 */
class DetailsController extends Controller
{
    /**
     * {{ '@' . 'param ' . $model . ' $' . $var }}
     * {{ '@' . 'return View' }}
     */
    public function __invoke({{ $model }} ${{ $var }}): View
    {
        return view(
            '{{ $route }}.details',
            [
                '{{ $var }}' => ${{ $var }},
            ]
        );
    }
}
