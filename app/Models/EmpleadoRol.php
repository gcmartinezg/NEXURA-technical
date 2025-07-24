namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoRole extends Pivot
{
    protected $table = 'empleado_roles';
}