{!! '<' . '?php' !!}

declare(strict_types=1);

namespace App\Http\Controllers\{{ $namespace }};

use App\Http\Controllers\Controller;
use App\Models\{{ $modelNamespace }};
use Exception;
use Illuminate\Http\RedirectResponse;

/**
 * Class DeleteController
 * {{ '@' . 'package App\Http\Controllers\\' . $namespace }}
 */
class DeleteController extends Controller
{
    /**
     * {{ '@' . 'param ' . $model . ' $' . $var }}
     * {{ '@' . 'return RedirectResponse' }}
     * {{ '@' . 'throws Exception' }}
     */
    public function __invoke({{ $model }} ${{ $var }}): RedirectResponse
    {
        if (${{ $var }}->delete()) {
            flash()->success(__('The {{ lcfirst($model) }} has been deleted.'));
        } else {
            flash()->error(__('The {{ lcfirst($model) }} could not be deleted. Please, try again.'));
        }

        return redirect()->route('{{ $route }}.index');
    }
}
