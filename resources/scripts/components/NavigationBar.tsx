import * as React from "react";
import { useState } from "react";
import { Link, NavLink } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCogs, faLayerGroup, faSignOutAlt } from "@fortawesome/free-solid-svg-icons";
import { useStoreState } from "easy-peasy";
import { ApplicationStore } from "@/state";
import SearchContainer from "@/components/dashboard/search/SearchContainer";
import tw, { theme } from "twin.macro";
import styled from "styled-components/macro";
import http from "@/api/http";
import SpinnerOverlay from "@/components/elements/SpinnerOverlay";
import Tooltip from "@/components/elements/tooltip/Tooltip";
import Avatar from "@/components/Avatar";

const RightNavigation = styled.div`
  & > a,
  & > button,
  & > .navigation-link {
    ${tw`flex items-center h-full no-underline text-neutral-300 px-6 cursor-pointer transition-all duration-150`};

    &:active,
    &:hover {
      ${tw`text-neutral-100 opacity-75`};
    }

    &:active,
    &:hover,
    &.active {
      box-shadow: inset 0 -2px ${theme`colors.cyan.600`.toString()};
    }
  }
`;

export default () => {
  const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
  const rootAdmin = useStoreState((state: ApplicationStore) => state.user.data!.rootAdmin);
  const [isLoggingOut, setIsLoggingOut] = useState(false);

  const onTriggerLogout = () => {
    setIsLoggingOut(true);
    http.post("/auth/logout").finally(() => {
      // @ts-expect-error this is valid
      window.location = "/";
    });
  };

  return (
    <div css={tw`w-full bg-gradient-to-b from-[#483d8b] to-[#070707] shadow-md overflow-x-auto`}>
      <SpinnerOverlay visible={isLoggingOut} />
      <div css={tw`mx-auto w-full flex items-center h-[3.5rem] max-w-[1200px]`}>
        <div id={"logo"} css={tw`flex-1`}>
          <Link to={"/"} css={tw`no-underline transition-colors duration-150 mx-4`}>
            <img src='/assets/svgs/waffle_long.svg' css={tw`w-[158px] h-[158px] hidden md:block`} alt='WaffleStudio' />
            <img src='/assets/svgs/waffle.svg' css={tw`w-[158px] h-[158px] block md:hidden`} alt='WaffleStudio' />
          </Link>
        </div>
        <RightNavigation css={tw`flex h-full items-center justify-center`}>
          <SearchContainer />
          <Tooltip placement={"bottom"} content={"แดชบอร์ด"}>
            <NavLink to={"/"} exact>
              <FontAwesomeIcon icon={faLayerGroup} />
            </NavLink>
          </Tooltip>
          {rootAdmin && (
            <Tooltip placement={"bottom"} content={"ผู้ดูแลระบบ"}>
              <a href={"/admin"} rel={"noreferrer"}>
                <FontAwesomeIcon icon={faCogs} />
              </a>
            </Tooltip>
          )}
          <Tooltip placement={"bottom"} content={"ตั้งค่าบัญชี"}>
            <NavLink to={"/account"}>
              <span className={"flex items-center w-5 h-5"}>
                <Avatar.User />
              </span>
            </NavLink>
          </Tooltip>
          <Tooltip placement={"bottom"} content={"ออกจากระบบ"}>
            <button onClick={onTriggerLogout}>
              <FontAwesomeIcon icon={faSignOutAlt} />
            </button>
          </Tooltip>
        </RightNavigation>
      </div>
    </div>
  );
};
