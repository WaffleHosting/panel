import React from "react";
import { ServerContext } from "@/state/server";
import ScreenBlock from "@/components/elements/ScreenBlock";
import ServerInstallSvg from "@/assets/images/server_installing.svg";
import ServerErrorSvg from "@/assets/images/server_error.svg";
import ServerRestoreSvg from "@/assets/images/server_restore.svg";

export default () => {
  const status = ServerContext.useStoreState((state) => state.server.data?.status || null);
  const isTransferring = ServerContext.useStoreState((state) => state.server.data?.isTransferring || false);
  const isNodeUnderMaintenance = ServerContext.useStoreState(
    (state) => state.server.data?.isNodeUnderMaintenance || false,
  );

  return status === "installing" || status === "install_failed" || status === "reinstall_failed" ? (
    <ScreenBlock
      title={"เซิร์ฟเวอร์กำลังติดตั้ง"}
      image={ServerInstallSvg}
      message={"เซิร์ฟเวอร์ของท่านจะพร้อมในเร็วๆนี้ โปรดลองอีกทีในภายหลัง"}
    />
  ) : status === "suspended" ? (
    <ScreenBlock
      title={"เซิร์ฟเวอร์ถูกระงับ"}
      image={ServerErrorSvg}
      message={"เซิร์ฟเวอร์นี้ถูกระงับและไม่สามารถเข้าถึงได้ โปรดติดต่อผู้ดูแลระบบโดยด่วน"}
    />
  ) : isNodeUnderMaintenance ? (
    <ScreenBlock
      title={"Node นี้กำลังปิดปรับปรุง"}
      image={ServerErrorSvg}
      message={"Node ที่เซิร์ฟเวอร์นี้อยู่กำลังปิดปรับปรุงอยู่ โปรดติดต่อผู้ดูแลระบบสำหรับข้อมูลเพิ่มเติม"}
    />
  ) : (
    <ScreenBlock
      title={isTransferring ? "กำลังย้ายเซิร์ฟเวอร์ไปยังอีก Node นึง" : "กำลังดึงค่าจาก การสำรองข้อมูล"}
      image={ServerRestoreSvg}
      message={
        isTransferring
          ? "เซิร์ฟเวอร์ของคุณกำลังถูกโอนย้ายไปยังโหนดใหม่ กรุณาตรวจสอบอีกครั้งในภายหลัง"
          : "เซิร์ฟเวอร์ของคุณกำลังถูกกู้คืนจากการสำรองข้อมูล กรุณาตรวจสอบอีกครู่ในไม่กี่นาที"
      }
    />
  );
};
