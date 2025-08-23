
import katex from 'katex';
import 'katex/dist/katex.min.css';

const MatriksKaTeX = () => {
  const renderMath = (math) => {
    return <span dangerouslySetInnerHTML={{ __html: katex.renderToString(math) }} />;
  };

  return (
    <div>
      <h1>Menampilkan Matriks dengan KaTeX</h1>
      <p>Berikut adalah matriks 3x3 yang ditulis dengan LaTeX:</p>
      <div>
        {renderMath('\\begin{bmatrix} 1 & 2 & 3 \\\\ 4 & 5 & 6 \\\\ 7 & 8 & 9 \\end{bmatrix}')}
      </div>
    </div>
  );
};

export default MatriksKaTeX;
