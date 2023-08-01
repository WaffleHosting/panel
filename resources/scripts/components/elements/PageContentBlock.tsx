import React, { useEffect } from "react";
import ContentContainer from "@/components/elements/ContentContainer";
import { CSSTransition } from "react-transition-group";
import tw from "twin.macro";
import FlashMessageRender from "@/components/FlashMessageRender";

export interface PageContentBlockProps {
  title?: string;
  className?: string;
  showFlashKey?: string;
}

const PageContentBlock: React.FC<PageContentBlockProps> = ({ title, showFlashKey, className, children }) => {
  useEffect(() => {
    if (title) {
      document.title = title;
    }
  }, [title]);

  return (
    <CSSTransition timeout={150} classNames={"fade"} appear in>
      <>
        <ContentContainer css={tw`my-4 sm:my-10`} className={className}>
          {showFlashKey && <FlashMessageRender byKey={showFlashKey} css={tw`mb-4`} />}
          {children}
        </ContentContainer>
        <ContentContainer css={tw`mb-4`}>
          <p css={tw`text-center text-neutral-500 text-xs mt-4 transition hover:opacity-75`}>
            &copy; 2015 - {new Date().getFullYear()}&nbsp;
            <a rel={"noopener nofollow noreferrer"} href={"https://pterodactyl.io"} target={"_blank"}>
              <span css={tw`no-underline transition text-yellow-500 hover:text-yellow-300`}>WaffleStudio panel</span>{" "}
              built on.{" "}
              <span css={tw`underline transition text-cyan-500 hover:text-cyan-300`}>Pterodactyl Software</span>
            </a>
          </p>
        </ContentContainer>
      </>
    </CSSTransition>
  );
};

export default PageContentBlock;
