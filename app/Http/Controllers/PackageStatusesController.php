<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\PackageStatus;
use App\Helpers\Flash;

/**
 * PackageStatusesController
 *
 * @author Victor Lantigua <vmlantigua@gmail.com>
 */
class PackageStatusesController extends BaseAuthController {

    public function __construct(Guard $auth)
    {
        parent::__construct($auth);
        $this->middleware('agent');
    }

    /**
     * Shows a list of package statuses.
     */
    public function getIndex()
    {
        $statuses = PackageStatus::allByCurrentCompany();
        return view('package_statuses.index', ['statuses' => $statuses]);
    }

    /**
     * Shows the form for creating a new package status.
     */
    public function getCreate()
    {
        return view('package_statuses.form', ['status' => new PackageStatus]);
    }

    /**
     * Creates a new package status.
     */
    public function postStore(Request $request)
    {
        $input = $request->all();
        $input['company_id'] = $this->user->company_id;

        // Validate input
        $this->validate($input, PackageStatus::$rules);

        // Create status
        if (isset($input['is_default'])) {
            // Unset default status so we can reset it below
            PackageStatus::unsetDefaultByCompanyId($this->user->company_id);
        }

        PackageStatus::create($input);

        return $this->redirectWithSuccess('package-statuses', 'Package status created.');

    }

    /**
     * Shows the form for editing a package status.
     */
    public function getEdit($id)
    {
        $status = PackageStatus::findOrFailByIdAndCurrentCompany($id);
        return view('package_statuses.form', ['status' => $status]);
    }

    /**
     * Updates a specific package status.
     */
    public function postUpdate(Request $request, $id)
    {
        $input = $request->all();
        $input['company_id'] = $this->user->company_id;

        // Validate input
        $this->validate($input, PackageStatus::$rules);

        // Update status
        $status = PackageStatus::findOrFailByIdAndCurrentCompany($id);

        if (isset($input['is_default']) && ! $status->is_default) {
            // Unset default status so we can reset it below
            PackageStatus::unsetDefaultByCompanyId($this->user->company_id);
        }

        $status->update($input);

        return $this->redirectBackWithSuccess('Package status updated.');
    }

    /**
     * Deletes a specific package status.
     */
    public function getDelete(Request $request, $id)
    {
        $status = PackageStatus::findByIdAndCurrentCompany($id);

        if ($status && $status->delete()) {
            return $this->redirectBackWithSuccess('Package status deleted.');
        }

        return $this->redirectBackWithError('Package status delete failed.');
    }
}
