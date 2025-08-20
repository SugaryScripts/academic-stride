import React from 'react';
import {
  Pagination,
  PaginationContent,
  PaginationItem,
  PaginationLink,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination';
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area';

const PaginationControls = ({ totalQuestions, currentQuestion, onPageChange }) => {
  const totalPages = totalQuestions;
  const currentPage = currentQuestion;

  const allPages = Array.from({ length: totalPages }, (_, i) => i);

  return (
    <div className="flex items-center space-x-2 list-none">
      <PaginationItem>
        <PaginationPrevious
          onClick={() => onPageChange(currentPage - 1)}
          className={currentPage === 0 ? 'pointer-events-none opacity-50' : ''}
        />
      </PaginationItem>

      <ScrollArea className="w-96 whitespace-nowrap">
        <Pagination>
          <PaginationContent className="flex flex-nowrap justify-center space-x-2 mb-2">
            {allPages.map((page) => (
              <PaginationItem key={page}>
                <PaginationLink
                  href="#"
                  isActive={page === currentPage}
                  onClick={() => onPageChange(page)}
                >
                  {page + 1}
                </PaginationLink>
              </PaginationItem>
            ))}
          </PaginationContent>
        </Pagination>
        <ScrollBar orientation="horizontal" />
      </ScrollArea>

      <PaginationItem>
        <PaginationNext
          onClick={() => onPageChange(currentPage + 1)}
          className={currentPage === totalPages - 1 ? 'pointer-events-none opacity-50' : ''}
        />
      </PaginationItem>
    </div>
  );
};

export default PaginationControls;
