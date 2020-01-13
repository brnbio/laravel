{!! '<' . '?php' !!}

declare(strict_types=1);

namespace App\Http\Controllers\{{ $namespace }};

use App\Http\Controllers\Controller;
use App\Models\{{ $modelNamespace }};
use Illuminate\View\View;

/**
 * Class IndexController
 * {{ '@' . 'package App\Http\Controllers\\' . $namespace }}
 */
class IndexController extends Controller
{
    /**
     * {{ '@' . 'return View' }}
     */
    public function __invoke(): View
    {
        ${{ $vars }} = {{ $model }}::query()->paginate();

        return view(
            '{{ $route }}.index',
            [
                '{{ $vars }}' => ${{ $vars }},
            ]
        );
    }
}
