            <?php
            include '../db/dbconnect.php';
            include 'assets/include/admin_header.php';

            $result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
            ?>
            <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
                  <div class="row ">
                    <div class="col-lg-5">

                        <h5 class="mb-0"><strong>Contact Us</strong></h5>
                        <span class="text-secondary">Dashboard <i class="fa fa-angle-right"></i> View Customer Messages</span>
                      </div>
                    <div class="table-responsive">
              <table clid="example" class="table table-striped table-bordered"">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date Sent</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= $row['id']; ?></td>
                      <td><?= htmlspecialchars($row['name']); ?></td>
                      <td><?= htmlspecialchars($row['email']); ?></td>
                      <td><?= nl2br(htmlspecialchars($row['message'])); ?></td>
                      <td><?= $row['created_at']; ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <?php
        include 'assets/include/admin_footer.php';
      ?>
