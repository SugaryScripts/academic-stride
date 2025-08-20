import Navbar from "../layouts/Navbar";
import Footer from "../layouts/Footer";


const Home = () => {
  return (
    <div>
    <Navbar />
    <div className="w-full bg-white flex flex-col items-center">
        <main className="w-full flex flex-col gap-5 md:gap-8 lg:gap-10 items-center">
            <section className="w-full bg-gray-100">
                <div className="container my-4 mx-auto flex flex-col lg:flex-row items-center w-full mt-10 md:mt-16 lg:mt-20 gap-8 lg:gap-16">
                    <div className="flex flex-col gap-4 md:gap-6 lg:gap-8 w-full lg:flex-1 order-2 lg:order-1">
                        <div className="flex flex-col gap-2 md:gap-4 w-full">
                            <h1 className="text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight md:leading-snug lg:leading-normal text-left text-gray-700">
                                <span className="text-gray-700">Tes Kemampuan Akademik untuk </span>
                                <span className="text-red-600">SD, SMP, dan SMA</span>
                            </h1>
                            <p className="text-sm md:text-base text-gray-500">
                                Uji kemampuan akademik siswa Indonesia secara daring dengan platform GarudaCerdas.id
                            </p>
                        </div>
                        <button
                            variant="primary"
                            onClick={() => {}}
                            className="mt-4 px-6 py-2 w-40 bg-primary text-white rounded-md"
                            >
                            Mulai Tes
                        </button>
                    </div>
                    <div className="w-full lg:w-[32%] order-1 lg:order-2">
                        <img
                            src="/logo/laptopbird.svg"
                            alt="Illustration"
                            className="w-full h-auto max-w-sm mx-auto"
                        />
                    </div>
                </div>
            </section>


        {/* Education Levels Section */}
        <section className="w-full py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col gap-4 md:gap-8 items-center">

              {/* Section Header */}
              <div className="flex flex-col gap-2 md:gap-4 text-center px-4">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Jenjang Pendidikan
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  Tes TKA tersedia pada GarudaCerdas.id untuk berbagai jenjang pendidikan.
                </p>
              </div>

              {/* Education Cards */}
              <div className="flex flex-col lg:flex-row gap-8 lg:gap-12 w-full mt-4">

                {/* SD Card */}
                <div className="flex-1 flex flex-col gap-2 md:gap-4 p-4 lg:p-6 bg-white shadow-md rounded-md items-center text-center">
                  {/* <img src="/images/img_ilustrasi_06_1.png" alt="SD Illustration" className="w-24 md:w-32 lg:w-40 h-auto" /> */}
                  <h3 className="text-lg md:text-xl lg:text-2xl font-semibold text-gray-700">SD</h3>
                  <p className="text-xs md:text-sm text-gray-500">
                    Platform ini menyediakan Tes Kemampuan Akademik yang dirancang khusus untuk peserta didik Sekolah Dasar guna mengukur kemampuan dasar mereka dalam literasi, numerasi, dan logika berpikir.
                  </p>
                </div>

                {/* SMP Card */}
                <div className="flex-1 flex flex-col gap-2 md:gap-4 p-4 lg:p-6 bg-white shadow-md rounded-md items-center text-center">
                  {/* <img src="/images/img_ilustrasi_07_1.png" alt="SMP Illustration" className="w-24 md:w-32 lg:w-40 h-auto" /> */}
                  <h3 className="text-lg md:text-xl lg:text-2xl font-semibold text-gray-700">SMP</h3>
                  <p className="text-xs md:text-sm text-gray-500">
                    GarudaCerdas menghadirkan soal-soal TKA yang disesuaikan dengan kompetensi inti siswa tingkat SMP, mencakup kemampuan analisis, pemahaman bacaan, serta matematika terapan.
                  </p>
                </div>

                {/* SMA Card */}
                <div className="flex-1 flex flex-col gap-2 md:gap-4 p-4 lg:p-6 bg-white shadow-md rounded-md items-center text-center">
                  {/* <img src="/images/img_ilustrasi_1.png" alt="SMA Illustration" className="w-24 md:w-32 lg:w-40 h-auto" /> */}
                  <h3 className="text-lg md:text-xl lg:text-2xl font-semibold text-gray-700">SMA</h3>
                  <p className="text-xs md:text-sm text-gray-500">
                    Untuk siswa jenjang SMA, kami menyajikan TKA dengan tingkat kesulitan yang lebih tinggi guna mempersiapkan mereka menghadapi seleksi masuk perguruan tinggi maupun asesmen nasional berbasis kompetensi.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Subjects Section */}
        <section className="w-full py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col gap-4 md:gap-8 items-center">
              <div className="flex flex-col gap-2 md:gap-4 text-center px-4 max-w-2xl">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Mata Pelajaran
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  Tes TKA mencakup berbagai mata pelajaran inti yang dirancang untuk mengukur kemampuan akademik siswa secara komprehensif sesuai jenjang pendidikan.
                </p>
              </div>
              <div className="w-10 h-10 md:w-16 md:h-16 mt-4">
                {/* <img src="/images/img_logo.png" alt="Logo" className="w-full h-full object-contain" /> */}
              </div>
            </div>
          </div>
        </section>

        {/* About TKA Section */}
        <section className="w-full py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">

              {/* Image */}
              <div className="w-full lg:w-1/2 order-2 lg:order-1">
                {/* <img src="/images/img_frame_35.png" alt="TKA Illustration" className="w-full h-auto max-w-lg mx-auto" /> */}
              </div>

              {/* Content */}
              <div className="flex flex-col gap-4 md:gap-6 lg:gap-8 w-full lg:w-1/2 order-1 lg:order-2">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Tentang Tes Kemampuan Akademik
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  Tes Kemampuan Akademik (TKA) merupakan evaluasi berbasis digital yang dirancang untuk mengukur tingkat pemahaman, penalaran logis, serta kemampuan numerasi dan literasi siswa di jenjang SD, SMP, dan SMA. Melalui pendekatan yang adaptif dan terstandar, TKA di GarudaCerdas.id membantu peserta memahami kekuatan dan kelemahan akademiknya secara objektif, serta mendukung proses belajar yang lebih terarah.
                </p>
                {/* <Button
                  variant="primary"
                  onClick={() => {}}
                  className="mt-4 px-6 py-2 md:px-8 md:py-3 lg:px-10 lg:py-4 bg-red-600 text-white rounded-md"
                >
                  Pelajari Lebih Lanjut
                </Button> */}
              </div>
            </div>
          </div>
        </section>

        {/* School Partners Section */}
        <section className="w-full bg-gray-100 py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col lg:flex-row items-start gap-8 lg:gap-16">

              {/* Text Content */}
              <div className="flex flex-col gap-2 md:gap-4 w-full lg:flex-1">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Mitra Sekolah
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  Pencapaian ini kami raih melalui kolaborasi dengan sekolah-sekolah di seluruh Indonesia, serta komitmen kami dalam menyediakan layanan edukasi digital yang unggul dan terpercaya.
                </p>
              </div>

              {/* Statistics */}
              <div className="flex flex-col sm:flex-row gap-6 md:gap-8 lg:gap-10 w-full lg:w-1/2">

                {/* School Partners Stat */}
                <div className="flex gap-4 items-center flex-1">
                  {/* <img src="/images/img_icon_48x48.png" alt="School Icon" className="w-12 h-12" /> */}
                  <div className="flex flex-col">
                    <h3 className="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-700">
                      46,328
                    </h3>
                    <p className="text-sm md:text-base text-gray-500">
                      Mitra Sekolah
                    </p>
                  </div>
                </div>

                {/* Students Stat */}
                <div className="flex gap-4 items-center flex-1">
                  {/* <img src="/images/img_icon_1.png" alt="Students Icon" className="w-12 h-12" /> */}
                  <div className="flex flex-col">
                    <h3 className="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-700">
                      2,245,341
                    </h3>
                    <p className="text-sm md:text-base text-gray-500">
                      Siswa telah mendaftar
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* News & Announcements Section */}
        <section className="w-full py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col gap-4 md:gap-8 items-center">

              {/* Section Header */}
              <div className="flex flex-col gap-2 md:gap-4 text-center px-4 max-w-2xl">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Berita & Pengumuman
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  GarudaCerdas.id menghadirkan informasi terkini seputar kegiatan, pengumuman penting, serta berbagai wawasan pendidikan untuk siswa, orang tua, dan mitra sekolah.
                </p>
              </div>

              {/* News Cards */}
              <div className="flex flex-col lg:flex-row gap-6 lg:gap-8 w-full mt-8">

                {/* News Card 1 */}
                <div className="flex flex-col items-center flex-1 relative">
                  {/* <img src="/images/img_image_18.png" alt="News Image" className="w-full rounded-lg" /> */}
                  <div className="bg-gray-100 p-4 shadow-md rounded-lg mx-4 -mt-12 relative z-10 flex flex-col gap-2">
                    <p className="text-base md:text-lg font-semibold text-center text-gray-500">
                      Meningkatkan Efektivitas Tes TKA Bersama Sekolah Mitra
                    </p>
                    <div className="flex items-center justify-center text-red-600 font-semibold gap-2">
                      <span>Baca Lebih Lanjut</span>
                      {/* <img src="/images/img_24_arrows_directions_right.svg" alt="Arrow" className="w-4 h-4" /> */}
                    </div>
                  </div>
                </div>

                {/* News Card 2 */}
                <div className="flex flex-col items-center flex-1 relative">
                  {/* <img src="/images/img_image_19.png" alt="News Image" className="w-full rounded-lg" /> */}
                  <div className="bg-gray-100 p-4 shadow-md rounded-lg mx-4 -mt-12 relative z-10 flex flex-col gap-2">
                    <p className="text-base md:text-lg font-semibold text-center text-gray-500">
                      Apa Saja Tanggung Jawab Akademik Siswa dan Cara Mengelolanya?
                    </p>
                    <div className="flex items-center justify-center text-red-600 font-semibold gap-2">
                      <span>Baca Lebih Lanjut</span>
                      {/* <img src="/images/img_24_arrows_directions_right.svg" alt="Arrow" className="w-4 h-4" /> */}
                    </div>
                  </div>
                </div>

                {/* News Card 3 */}
                <div className="flex flex-col items-center flex-1 relative">
                  {/* <img src="/images/img_image_20.png" alt="News Image" className="w-full rounded-lg" /> */}
                  <div className="bg-gray-100 p-4 shadow-md rounded-lg mx-4 -mt-12 relative z-10 flex flex-col gap-2">
                    <p className="text-base md:text-lg font-semibold text-center text-gray-500">
                      Transformasi Digital di Dunia Pendidikan: Cerita dari Lapangan
                    </p>
                    <div className="flex items-center justify-center text-red-600 font-semibold gap-2">
                      <span>Baca Lebih Lanjut</span>
                      {/* <img src="/images/img_24_arrows_directions_right.svg" alt="Arrow" className="w-4 h-4" /> */}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Learning Modules Section */}
        <section className="w-full py-16">
          <div className="container mx-auto px-4 md:px-6">
            <div className="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">

              {/* Content */}
              <div className="flex flex-col gap-4 md:gap-6 lg:gap-8 w-full lg:w-1/2 order-2 lg:order-1">
                <h2 className="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-700">
                  Modul Pembelajaran
                </h2>
                <p className="text-sm md:text-base text-gray-500">
                  Modul Pembelajaran di GarudaCerdas dirancang untuk membantu siswa memahami materi secara mendalam sesuai kurikulum dan jenjang pendidikan masing-masing. Setiap modul disusun secara sistematis, interaktif, dan dapat diakses kapan saja, sehingga mendukung pembelajaran mandiri maupun terstruktur bersama guru.
                </p>
                {/* <Button
                  variant="primary"
                  onClick={() => {}}
                  className="mt-4 px-6 py-2 md:px-8 md:py-3 lg:px-10 lg:py-4 bg-red-600 text-white rounded-md"
                >
                  Pelajari Selengkapnya
                </Button> */}
              </div>

              {/* Image */}
              <div className="w-full lg:w-1/2 order-1 lg:order-2">
                {/* <img src="/images/img_untitled_1_02_1.png" alt="Learning Module Illustration" className="w-full h-auto max-w-lg mx-auto" /> */}
              </div>
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
    </div>
  );
};

export default Home;
