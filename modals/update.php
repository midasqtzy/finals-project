<!-- Edit Modal -->
<div class="modal fade" id="updateModal<?= $studentId ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="backend/user_code.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Update Clearance Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="member_id" value="<?= $studentId ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($student->first_name ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($student->last_name ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student->email ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="Male" <?= ($student->gender ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($student->gender ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Course</label>
                            <select name="course" class="form-select" required>
                                <option value="" disabled <?= empty($currentCourse) ? 'selected' : '' ?>>Select Course</option>
                                <option value="BSIT" <?= $currentCourse === 'BSIT' ? 'selected' : '' ?>>BSIT</option>
                                <option value="BSCS" <?= $currentCourse === 'BSCS' ? 'selected' : '' ?>>BSCS</option>
                                <option value="BSCpE" <?= $currentCourse === 'BSCpE' ? 'selected' : '' ?>>BSCpE</option>
                                <option value="BSIS" <?= $currentCourse === 'BSIS' ? 'selected' : '' ?>>BSIS</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Year & Section</label>
                            <select name="section" class="form-select" required>
                                <option value="" disabled <?= empty($currentSec) ? 'selected' : '' ?>>Select Year & Sec</option>
                                <optgroup label="1st Year">
                                    <option value="1A" <?= $currentSec === '1A' ? 'selected' : '' ?>>1A</option>
                                    <option value="1B" <?= $currentSec === '1B' ? 'selected' : '' ?>>1B</option>
                                    <option value="1C" <?= $currentSec === '1C' ? 'selected' : '' ?>>1C</option>
                                    <option value="1D" <?= $currentSec === '1D' ? 'selected' : '' ?>>1D</option>
                                </optgroup>
                                <optgroup label="2nd Year">
                                    <option value="2A" <?= $currentSec === '2A' ? 'selected' : '' ?>>2A</option>
                                    <option value="2B" <?= $currentSec === '2B' ? 'selected' : '' ?>>2B</option>
                                    <option value="2C" <?= $currentSec === '2C' ? 'selected' : '' ?>>2C</option>
                                    <option value="2D" <?= $currentSec === '2D' ? 'selected' : '' ?>>2D</option>
                                </optgroup>
                                <optgroup label="3rd Year">
                                    <option value="3A" <?= $currentSec === '3A' ? 'selected' : '' ?>>3A</option>
                                    <option value="3B" <?= $currentSec === '3B' ? 'selected' : '' ?>>3B</option>
                                    <option value="3C" <?= $currentSec === '3C' ? 'selected' : '' ?>>3C</option>
                                    <option value="3D" <?= $currentSec === '3D' ? 'selected' : '' ?>>3D</option>
                                </optgroup>
                                <optgroup label="4th Year">
                                    <option value="4A" <?= $currentSec === '4A' ? 'selected' : '' ?>>4A</option>
                                    <option value="4B" <?= $currentSec === '4B' ? 'selected' : '' ?>>4B</option>
                                    <option value="4C" <?= $currentSec === '4C' ? 'selected' : '' ?>>4C</option>
                                    <option value="4D" <?= $currentSec === '4D' ? 'selected' : '' ?>>4D</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($student->address ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Clearance Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Pending" <?= (($student->status ?? 'Pending') === 'Pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="In Review" <?= (($student->status ?? 'Pending') === 'In Review') ? 'selected' : '' ?>>In Review</option>
                            <option value="Cleared" <?= (($student->status ?? 'Pending') === 'Cleared') ? 'selected' : '' ?>>Cleared</option>
                            <option value="Needs Revision" <?= (($student->status ?? 'Pending') === 'Needs Revision') ? 'selected' : '' ?>>Needs Revision</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pending Requirements</label>
                        <textarea name="pending_requirements" class="form-control" rows="2"><?= htmlspecialchars($student->pending_requirements ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Officer Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2"><?= htmlspecialchars($student->remarks ?? '') ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_member" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>