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
 * Class CreateController
 * {{ '@' . 'package App\Http\Controllers\\' . $namespace }}
 */
class CreateController extends Controller
{
    /**
     * {{ '@' . 'return View' }}
     */
    public function __invoke(): View
    {
        return view(
            '{{ $route }}.create',
            [
                '{{ $var }}' => new {{ $model }}(),
            ]
        );
    }

    /**
     * {{ '@' . 'param Request $request' }}
     * {{ '@' . 'return RedirectResponse' }}
     * {{ '@' . 'throws Exception' }}
     */
    public function store(Request $request): RedirectResponse
    {
        ${{ $var }} = new {{ $model }}($request->post());

        if (!$item->save()) {
            flash()->error(__('The {{ lcfirst($model) }} could not be saved. Please, try again.'));
            return redirect()->back();
        }
        flash()->success(__('The {{ lcfirst($model) }} has been saved.'));

        return redirect()->route('{{ $route }}.details', ${{ $var }});
    }
}
