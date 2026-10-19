<!-- Add Member Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #ffffff; border: 1px solid #f0e6e6; color: #000000; border-radius: 10px; box-shadow: 0 10px 30px rgba(128, 0, 32, 0.08);">
      <div class="modal-header border-bottom px-4 py-3" style="border-color: #f0e6e6 !important; background-color: #faf2f2;">
        <h1 class="modal-title fs-6 fw-bold text-black" id="addModalLabel">Add Clearance Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/user_code.php" method="POST">
        <div class="modal-body p-4">
          <div class="row g-3">
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="First Name" name="first_name" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="Last Name" name="last_name" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12">
              <input type="email" class="form-control text-black fw-medium" placeholder="Email" name="email" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12 col-sm-6">
              <select class="form-select text-black fw-medium" name="gender" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
                <option value="" disabled selected style="background-color: #ffffff; color: #2b2b2b;">Gender</option>
                <option value="Male" style="background-color: #ffffff; color: #000000;">Male</option>
                <option value="Female" style="background-color: #ffffff; color: #000000;">Female</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <select class="form-select text-black fw-medium" name="course" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
                <option value="" disabled selected style="background-color: #ffffff; color: #2b2b2b;">Course</option>
                <option value="BSIT" style="background-color: #ffffff; color: #000000;">BSIT</option>
                <option value="BSCS" style="background-color: #ffffff; color: #000000;">BSCS</option>
                <option value="BSIS" style="background-color: #ffffff; color: #000000;">BSIS</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <select class="form-select text-black fw-medium" name="year_level" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
                <option value="" disabled selected style="background-color: #ffffff; color: #2b2b2b;">Year Level</option>
                <option value="1st Year" style="background-color: #ffffff; color: #000000;">1st Year</option>
                <option value="2nd Year" style="background-color: #ffffff; color: #000000;">2nd Year</option>
                <option value="3rd Year" style="background-color: #ffffff; color: #000000;">3rd Year</option>
                <option value="4th Year" style="background-color: #ffffff; color: #000000;">4th Year</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="Section (e.g. A)" name="section" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12">
              <input type="text" class="form-control text-black fw-medium" placeholder="Address" name="address" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12">
              <select class="form-select text-black fw-medium" name="status" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
                <option value="Pending" selected>Pending</option>
                <option value="In Review">In Review</option>
                <option value="Cleared">Cleared</option>
                <option value="Needs Revision">Needs Revision</option>
              </select>
            </div>
            <div class="col-12">
              <textarea class="form-control text-black fw-medium" name="pending_requirements" rows="2" placeholder="Pending requirements or missing documents"
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;"></textarea>
            </div>
            <div class="col-12">
              <textarea class="form-control text-black fw-medium" name="remarks" rows="2" placeholder="Officer remarks"
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3" style="border-color: #f0e6e6 !important; background-color: #faf2f2;">
          <button type="button" class="btn btn-sm fw-bold px-3" style="background-color: transparent; border: 1px solid #f0e6e6; color: #2b2b2b; border-radius: 6px;" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="save_member" class="btn btn-sm px-3 fw-bold" style="background-color: #800020; color: #ffffff; border-radius: 6px;">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>