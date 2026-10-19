<!-- Register Student Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #ffffff; border: 1px solid #f0e6e6; color: #000000; border-radius: 10px; box-shadow: 0 10px 30px rgba(128, 0, 32, 0.08);">
      <div class="modal-header border-bottom px-4 py-3" style="border-color: #f0e6e6 !important; background-color: #faf2f2;">
        <h1 class="modal-title fs-6 fw-bold text-black" id="addModalLabel">Register Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/insert.php" method="POST">
        <div class="modal-body p-4">
          <div class="row g-3">
            <div class="col-12 col-sm-6">
              <input type="number" class="form-control text-black fw-medium" placeholder="Student ID" name="student_id" min="1" step="1" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="Full Name" name="name" maxlength="100" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="Course" name="course" maxlength="50" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12 col-sm-6">
              <input type="text" class="form-control text-black fw-medium" placeholder="Year &amp; Section (e.g. 3A)" name="year_section" maxlength="50" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12">
              <input type="text" class="form-control text-black fw-medium" placeholder="Username" name="username" minlength="4" maxlength="50" autocomplete="username" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div class="col-12">
              <input type="password" class="form-control text-black fw-medium" placeholder="Password (at least 8 characters)" name="password" minlength="8" autocomplete="new-password" required
                style="background-color: #fdfcfc; border: 1px solid #f0e6e6; color: #000000; padding: 0.55rem 0.75rem; font-size: 0.875rem;">
            </div>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3" style="border-color: #f0e6e6 !important; background-color: #faf2f2;">
          <button type="button" class="btn btn-sm fw-bold px-3" style="background-color: transparent; border: 1px solid #f0e6e6; color: #2b2b2b; border-radius: 6px;" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="register_student" class="btn btn-sm px-3 fw-bold" style="background-color: #800020; color: #ffffff; border-radius: 6px;">Register Student</button>
        </div>
      </form>
    </div>
  </div>
</div>