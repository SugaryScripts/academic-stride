export default function MenuList() {
  return (
    <>
      <li className="pc-item pc-caption">
        <label>Dashboard</label>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Dashboard</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Exam</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Subject</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Question Bank</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Student</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Exam Session</span>
        </a>
      </li>

      <li className="pc-item pc-hasmenu">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Grade</span>
        </a>
      </li>

      <li className="pc-item">
        <a href="#!" className="pc-link">
          <span className="pc-micon">
            <svg className="pc-icon">
              <use xlinkHref="#custom-status-up" />
            </svg>
          </span>
          <span className="pc-mtext">Logout</span>
        </a>
      </li>
    </>
  );
}
