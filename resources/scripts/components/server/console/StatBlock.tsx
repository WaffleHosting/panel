import React from "react";
import Icon from "@/components/elements/Icon";
import { IconDefinition } from "@fortawesome/free-solid-svg-icons";
import classNames from "classnames";
import styles from "./style.module.css";
import useFitText from "use-fit-text";
import CopyOnClick from "@/components/elements/CopyOnClick";
import tw from "twin.macro"

interface StatBlockProps {
  title: string;
  copyOnClick?: string;
  color?: string | undefined;
  icon: IconDefinition;
  children: React.ReactNode;
  className?: string;
}

export default ({ title, copyOnClick, icon, color, className, children }: StatBlockProps) => (
    <CopyOnClick text={copyOnClick}>
      <div className={classNames(styles.stat_block, "bg-[#060606]", className)}>
        <div className={classNames(styles.status_bar, color || "bg-[#060606]")} />
        <div className={classNames(styles.icon, color || "bg-[#060606]")}>
          <Icon
            icon={icon}
            className={classNames({
              "text-gray-100": !color || color === "bg-[#060606]",
              "text-gray-50": color && color !== "bg-[#060606]",
            })}
          />
        </div>
        <div css={tw`flex flex-col justify-center overflow-hidden w-full`}>
          <p css={tw`leading-tight text-xs md:text-sm text-white`}>{title}</p>
          <div css={tw`h-[1.75rem] w-full font-semibold text-white truncate text-sm`}>
            {children}
          </div>
        </div>
      </div>
    </CopyOnClick>
  );
