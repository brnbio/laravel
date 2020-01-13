{!! '<' . '?php' !!}

declare(strict_types=1);

namespace App\Http\Controllers\{{ $namespace }};

use App\Http\Controllers\Controller;
use App\Models\{{ $modelNamespace }};
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UpdateController
 * {{ '@' . 'package App\Http\Controllers\\' . $namespace }}
 */
class UpdateController extends Controller
{
    /**
     * {{ '@' . 'param ' . $model . ' $' . $var }}
     * {{ '@' . 'return View' }}
     */
    public function __invoke({{ $model }} ${{ $var }}): View
    {
        return view(
            '{{ $route }}.update',
            [
                '{{ $var }}' => ${{ $var }},
            ]
        );
    }

    /**
     * {{ '@' . 'param Request $request' }}
     * {{ '@' . 'param ' . $model . ' $' . $var }}
     * {{ '@' . 'return RedirectResponse' }}
     * {{ '@' . 'throws Exception' }}
     */
    public function store(Request $request, {{ $model }} ${{ $var }}): RedirectResponse
    {
        ${{ $var }}->fill($request->post());

        if (!${{ $var }}->save()) {
            flash()->error(__('The {{ lcfirst($model) }} could not be saved. Please, try again.'));
            return redirect()->back();
        }
        flash()->success(__('The {{ lcfirst($model) }} has been saved.'));

        return redirect()->route('{{ $route }}.details', ${{ $var }});
    }
}
