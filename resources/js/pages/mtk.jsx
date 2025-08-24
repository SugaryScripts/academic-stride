
import katex from 'katex';
import 'katex/dist/katex.min.css';
import Sidebar from '@/layouts/bootstrap/SidebarBoost';

const MatriksKaTeX = () => {
  const renderMath = (math) => {
    return <span dangerouslySetInnerHTML={{ __html: katex.renderToString(math) }} />;
  };

  return (
    <div>
        <Sidebar/>

    </div>
  );
};

export default MatriksKaTeX;
