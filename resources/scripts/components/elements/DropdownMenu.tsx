import React, { createRef } from "react";
import styled from "styled-components/macro";
import tw from "twin.macro";
import Fade from "@/components/elements/Fade";

interface Props {
  children: React.ReactNode;
  renderToggle: (onClick: (e: React.MouseEvent<any, MouseEvent>) => void) => React.ReactChild;
}

export const DropdownButtonRow = styled.button<{ danger?: boolean }>`
  ${tw`p-2 flex items-center transition rounded w-full text-white z-[100000000000]`};

  &:hover {
    ${(props) => (props.danger ? tw`text-red-700 bg-red-100` : tw`opacity-75 bg-[#010101]`)};
  }
`;

interface State {
  posX: number;
  visible: boolean;
}

class DropdownMenu extends React.PureComponent<Props, State> {
  menu = createRef<HTMLDivElement>();

  state: State = {
    posX: 0,
    visible: false,
  };

  componentWillUnmount() {
    this.removeListeners();
  }

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<State>) {
    const menu = this.menu.current;

    if (this.state.visible && !prevState.visible && menu) {
      document.addEventListener("click", this.windowListener);
      document.addEventListener("contextmenu", this.contextMenuListener);
      menu.style.left = `${Math.round(this.state.posX - menu.clientWidth)}px`;
    }

    if (!this.state.visible && prevState.visible) {
      this.removeListeners();
    }
  }

  removeListeners = () => {
    document.removeEventListener("click", this.windowListener);
    document.removeEventListener("contextmenu", this.contextMenuListener);
  };

  onClickHandler = (e: React.MouseEvent<any, MouseEvent>) => {
    e.preventDefault();
    this.triggerMenu(e.clientX);
  };

  contextMenuListener = () => this.setState({ visible: false });

  windowListener = (e: MouseEvent) => {
    const menu = this.menu.current;

    if (e.button === 2 || !this.state.visible || !menu) {
      return;
    }

    if (e.target === menu || menu.contains(e.target as Node)) {
      return;
    }

    if (e.target !== menu && !menu.contains(e.target as Node)) {
      this.setState({ visible: false });
    }
  };

  triggerMenu = (posX: number) =>
    this.setState((s) => ({
      posX: !s.visible ? posX : s.posX,
      visible: !s.visible,
    }));

  render() {
    return (
      <div>
        {this.props.renderToggle(this.onClickHandler)}
        <Fade timeout={150} in={this.state.visible} unmountOnExit>
          <div
            ref={this.menu}
            onClick={(e) => {
              e.stopPropagation();
              this.setState({ visible: false });
            }}
            style={{ width: "12rem" }}
            css={tw`absolute bg-[#000000] p-2 rounded border border-neutral-700 shadow-lg text-white z-50`}
          >
            {this.props.children}
          </div>
        </Fade>
      </div>
    );
  }
}

export default DropdownMenu;
