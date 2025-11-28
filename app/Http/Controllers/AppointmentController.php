namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor.user'])
            ->where('user_id', Auth::id())
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::with('poli')->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keluhan' => 'nullable'
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment berhasil dibuat!');
    }

    public function destroy($id)
    {
        $app = Appointment::findOrFail($id);

        if ($app->user_id != Auth::id()) {
            abort(403);
        }

        $app->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment berhasil dibatalkan.');
    }

        public function approve($id)
    {
        $app = Appointment::findOrFail($id);

        // Validasi hanya admin/dokter
        if (!in_array(auth()->user()->role, ['admin', 'doctor'])) {
            abort(403);
        }

        $app->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Appointment disetujui.');
    }

    public function reject($id)
    {
        $app = Appointment::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'doctor'])) {
            abort(403);
        }

        $app->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Appointment ditolak.');
    }

}
